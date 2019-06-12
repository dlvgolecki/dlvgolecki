if (!window.vc) var vc = {};



//

(function($) {
        vc.clone_index = 1, vc.shortcode_view = Backbone.View.extend({
            tagName: "div",
            $content: "",
            use_default_content: !1,
            params: {},
            events: {
                "click .column_delete,.vc_control-btn-delete": "deleteShortcode",
                "click .column_add,.vc_control-btn-prepend": "addElement",
                "click .column_edit,.vc_control-btn-edit, .column_edit_trigger": "editElement",
                "click .column_clone,.vc_control-btn-clone": "clone",
                mousemove: "checkControlsPosition"
            },
            removeView: function() {
                vc.closeActivePanel(this.model), this.remove()
            },
            checkControlsPosition: function() {
                if (this.$controls_buttons) {
                    var window_top, element_position_top, new_position, element_height = this.$el.height(),
                        window_height = $(window).height();
                    element_height > window_height && (window_top = $(window).scrollTop(), element_position_top = this.$el.offset().top, new_position = window_top - element_position_top + $(window).height() / 2, new_position > 40 && element_height > new_position ? this.$controls_buttons.css("top", new_position) : new_position > element_height ? this.$controls_buttons.css("top", element_height - 40) : this.$controls_buttons.css("top", 40))
                }
            },
            initialize: function() {
                this.model.bind("destroy", this.removeView, this), this.model.bind("change:params", this.changeShortcodeParams, this), this.model.bind("change_parent_id", this.changeShortcodeParent, this), this.createParams()
            },
            hasUserAccess: function() {
                var shortcodeTag;
                return shortcodeTag = this.model.get("shortcode"), -1 < _.indexOf(["vc_row", "vc_column", "vc_row_inner", "vc_column_inner"], shortcodeTag) ? !0 : _.every(vc.roles.current_user, function(role) {
                    return !(!_.isUndefined(vc.roles[role]) && !_.isUndefined(vc.roles[role].shortcodes) && _.isUndefined(vc.roles[role].shortcodes[shortcodeTag]))
                }) ? !0 : !1
            },
            canCurrentUser: function(action) {
                var tag, result = !1;
                return tag = this.model.get("shortcode"), result = void 0 === action || "all" === action ? vc_user_access().shortcodeAll(tag) : vc_user_access().shortcodeEdit(tag)
            },
            createParams: function() {
                var tag, settings, params;
                tag = this.model.get("shortcode"), settings = _.isObject(vc.map[tag]) && _.isArray(vc.map[tag].params) ? vc.map[tag].params : [], params = this.model.get("params"), this.params = {}, _.each(settings, function(param) {
                    this.params[param.param_name] = param
                }, this)
            },
            setContent: function() {
                this.$content = this.$el.find("> .wpb_element_wrapper > .vc_container_for_children, > .vc_element-wrapper > .vc_container_for_children")
            },
            setEmpty: function() {},
            unsetEmpty: function() {},
            checkIsEmpty: function() {
                this.model.get("parent_id") && vc.app.views[this.model.get("parent_id")].checkIsEmpty()
            },
            html2element: function(html) {
                var $template, attributes = {};
                _.isString(html) ? (this.template = _.template(html), $template = $(this.template(this.model.toJSON(), vc.templateOptions["default"]).trim())) : (this.template = html, $template = html), _.each($template.get(0).attributes, function(attr) {
                    attributes[attr.name] = attr.value
                }), this.$el.attr(attributes).html($template.html()), this.setContent(), this.renderContent()
            },
            render: function() {
                var $shortcode_template_el = $("#vc_shortcode-template-" + this.model.get("shortcode"));
                if ($shortcode_template_el.is("script")) this.html2element(_.template($shortcode_template_el.html(), this.model.toJSON(), vc.templateOptions["default"]));
                else {
                    var params = this.model.get("params");
                    $.ajax({
                        type: "POST",
                        url: window.ajaxurl,
                        data: {
                            action: "wpb_get_element_backend_html",
                            data_element: this.model.get("shortcode"),
                            data_width: _.isUndefined(params.width) ? "1/1" : params.width,
                            _vcnonce: window.vcAdminNonce
                        },
                        dataType: "html",
                        context: this
                    }).done(function(html) {
                        this.html2element(html)
                    })
                }
                return this.model.view = this, this.$controls_buttons = this.$el.find(".vc_controls > :first"), this
            },
            renderContent: function() {
                return this.$el.attr("data-model-id", this.model.get("id")), this.$el.data("model", this.model), this
            },
            changedContent: function(view) {},
            _loadDefaults: function() {
                var tag, hasChilds;
                tag = this.model.get("shortcode"), hasChilds = !!vc.shortcodes.where({
                    parent_id: this.model.get("id")
                }).length, !hasChilds && !0 === this.use_default_content && _.isObject(vc.map[tag]) && _.isString(vc.map[tag].default_content) && vc.map[tag].default_content.length && (this.use_default_content = !1, vc.shortcodes.createFromString(vc.map[tag].default_content, this.model))
            },
            _callJsCallback: function() {
                var tag = this.model.get("shortcode");
                if (_.isObject(vc.map[tag]) && _.isObject(vc.map[tag].js_callback) && !_.isUndefined(vc.map[tag].js_callback.init)) {
                    var fn = vc.map[tag].js_callback.init;
                    window[fn](this.$el)
                }
            },
            ready: function(e) {
                return this._loadDefaults(), this._callJsCallback(), this.model.get("parent_id") && _.isObject(vc.app.views[this.model.get("parent_id")]) && vc.app.views[this.model.get("parent_id")].changedContent(this), _.defer(_.bind(function() {
                    vc.events.trigger("shortcodeView:ready", this), vc.events.trigger("shortcodeView:ready:" + this.model.get("shortcode"), this)
                }, this)), this
            },
            addShortcode: function(view, method) {
                var before_shortcode;
                before_shortcode = _.last(vc.shortcodes.filter(function(shortcode) {
                    return shortcode.get("parent_id") === this.get("parent_id") && parseFloat(shortcode.get("order")) < parseFloat(this.get("order"))
                }, view.model)), before_shortcode ? view.render().$el.insertAfter("[data-model-id=" + before_shortcode.id + "]") : "append" === method ? this.$content.append(view.render().el) : this.$content.prepend(view.render().el)
            },
            changeShortcodeParams: function(model) {
                var tag, params, settings, view;
                tag = model.get("shortcode"), params = model.get("params"), settings = vc.map[tag], _.defer(function() {
                    vc.events.trigger("backend.shortcodeViewChangeParams:" + tag)
                }), _.isArray(settings.params) && _.each(settings.params, function(param_settings) {
                    var name, value, $wrapper, label_value, $admin_label;
                    if (name = param_settings.param_name, value = params[name], $wrapper = this.$el.find("> .wpb_element_wrapper, > .vc_element-wrapper"), label_value = value, $admin_label = $wrapper.children(".admin_label_" + name), _.isObject(vc.atts[param_settings.type]) && _.isFunction(vc.atts[param_settings.type].render) && (value = vc.atts[param_settings.type].render.call(this, param_settings, value)), $wrapper.children("." + param_settings.param_name).is("input,textarea,select")) $wrapper.children("[name=" + param_settings.param_name + "]").val(value);
                    else if ($wrapper.children("." + param_settings.param_name).is("iframe")) $wrapper.children("[name=" + param_settings.param_name + "]").attr("src", value);
                    else if ($wrapper.children("." + param_settings.param_name).is("img")) {
                        var $img;
                        $img = $wrapper.children("[name=" + param_settings.param_name + "]"), value && value.match(/^\d+$/) ? $.ajax({
                            type: "POST",
                            url: window.ajaxurl,
                            data: {
                                action: "wpb_single_image_src",
                                content: value,
                                size: "thumbnail",
                                _vcnonce: window.vcAdminNonce
                            },
                            dataType: "html",
                            context: this
                        }).done(function(url) {
                            $img.attr("src", url)
                        }) : value && $img.attr("src", value)
                    } else $wrapper.children("[name=" + param_settings.param_name + "]").html(value ? value : "");
                    if ($admin_label.length) {
                        var inverted_value;
                        "" === value || _.isUndefined(value) ? $admin_label.hide().addClass("hidden-label") : (_.isObject(param_settings.value) && !_.isArray(param_settings.value) && "checkbox" === param_settings.type ? (inverted_value = _.invert(param_settings.value), label_value = _.map(value.split(/[\s]*\,[\s]*/), function(val) {
                            return _.isString(inverted_value[val]) ? inverted_value[val] : val
                        }).join(", ")) : _.isObject(param_settings.value) && !_.isArray(param_settings.value) && (inverted_value = _.invert(param_settings.value), label_value = _.isString(inverted_value[value]) ? inverted_value[value] : value), $admin_label.html("<label>" + $admin_label.find("label").text() + "</label>: " + label_value), $admin_label.show().removeClass("hidden-label"))
                    }
                }, this), view = vc.app.views[model.get("parent_id")], !1 !== model.get("parent_id") && _.isObject(view) && view.checkIsEmpty()
            },
            changeShortcodeParent: function(model) {
                if (!1 === this.model.get("parent_id")) return model;
                var $parent_view = $("[data-model-id=" + this.model.get("parent_id") + "]"),
                    view = vc.app.views[this.model.get("parent_id")];
                this.$el.appendTo($parent_view.find("> .wpb_element_wrapper > .wpb_column_container, > .vc_element-wrapper > .wpb_column_container")), view.checkIsEmpty()
            },
            deleteShortcode: function(e) {
                _.isObject(e) && e.preventDefault();
                var answer = confirm(window.i18nLocale.press_ok_to_delete_section);
                !0 === answer && this.model.destroy()
            },
            addElement: function(e) {
                _.isObject(e) && e.preventDefault(), vc.add_element_block_view.render(this.model, !_.isObject(e) || !$(e.currentTarget).closest(".bottom-controls").hasClass("bottom-controls"))
            },
            editElement: function(e) {
                _.isObject(e) && e.preventDefault(), (!vc.active_panel || !vc.active_panel.model || !this.model || vc.active_panel.model && this.model && vc.active_panel.model.get("id") != this.model.get("id")) && (vc.closeActivePanel(), vc.edit_element_block_view.render(this.model))
            },
            clone: function(e) {
                return _.isObject(e) && e.preventDefault(), vc.clone_index /= 10, this.cloneModel(this.model, this.model.get("parent_id"))
            },
            cloneModel: function(model, parent_id, save_order) {
                var new_order, model_clone, params, tag;
                return new_order = _.isBoolean(save_order) && !0 === save_order ? model.get("order") : parseFloat(model.get("order")) + vc.clone_index, params = _.extend({}, model.get("params")), tag = model.get("shortcode"), model_clone = vc.shortcodes.create({
                    shortcode: tag,
                    id: window.vc_guid(),
                    parent_id: parent_id,
                    order: new_order,
                    cloned: !0,
                    cloned_from: model.toJSON(),
                    params: params
                }), _.each(vc.shortcodes.where({
                    parent_id: model.id
                }), function(shortcode) {
                    this.cloneModel(shortcode, model_clone.get("id"), !0)
                }, this), model_clone
            },
            remove: function() {
                this.$content && this.$content.data("uiSortable") && this.$content.sortable("destroy"), this.$content && this.$content.data("uiDroppable") && this.$content.droppable("destroy"), delete vc.app.views[this.model.id], window.vc.shortcode_view.__super__.remove.call(this)
            }
        });
    })(window.jQuery);

//





	window.VcBackendTtaViewInterface = vc.shortcode_view.extend({
            sortableSelector: !1,
            $sortable: !1,
            $navigation: !1,
            defaultSectionTitle: window.i18nLocale.tab,
            sortableUpdateModelIdSelector: "data-vc-target-model-id",
            activeClass: "vc_active",
            sortingPlaceholder: "vc_placeholder",
            events: {
                "click > .vc_controls .vc_control-btn-delete": "deleteShortcode",
                "click > .vc_controls .vc_control-btn-edit": "editElement",
                "click > .vc_controls .vc_control-btn-clone": "clone",
                "click > .vc_controls .vc_control-btn-prepend": "clickPrependSection",
                "click .vc_tta-section-append": "clickAppendSection"
            },
            initialize: function(params) {
                window.VcBackendTtaViewInterface.__super__.initialize.call(this, params), _.bindAll(this, "updateSorting")
            },
            render: function() {
                return window.VcBackendTtaViewInterface.__super__.render.call(this), this.$el.addClass("vc_tta-container vc_tta-o-non-responsive"), this
            },
            setContent: function() {
                this.$content = this.$el.find("> .wpb_element_wrapper .vc_tta-panels")
            },
            clickAppendSection: function(e) {
                e.preventDefault(), this.addSection()
            },
            clickPrependSection: function(e) {
                e.preventDefault(), this.addSection(!0)
            },
            addSection: function(prepend) {
                var newTabTitle, params, shortcode;
                return newTabTitle = this.defaultSectionTitle, params = {
                    shortcode: "vc_tta_section_team_slider",
                    params: {
                        title: newTabTitle
                    },
                    parent_id: this.model.get("id"),
                    order: _.isBoolean(prepend) && prepend ? vc.add_element_block_view.getFirstPositionIndex() : vc.shortcodes.getNextOrder(),
                    prepend: prepend
                }, shortcode = vc.shortcodes.create(params)
            },
            findSection: function(modelId) {
                return this.$content.children('[data-model-id="' + modelId + '"]')
            },
            getIndex: function($element) {
                return $element.index()
            },
            buildSortable: function($element) {
                return "edit" !== vc_user_access().getState("shortcodes") && vc_user_access().shortcodeAll("vc_tta_section_team_slider") ? $element.sortable({
                    forcePlaceholderSize: !0,
                    placeholder: this.sortingPlaceholder,
                    helper: this.renderSortingPlaceholder,
                    scroll: !0,
                    cursor: "move",
                    cursorAt: {
                        top: 20,
                        left: 16
                    },
                    start: function(event, ui) {},
                    over: function(event, ui) {},
                    stop: function(event, ui) {
                        ui.item.attr("style", "")
                    },
                    update: this.updateSorting,
                    items: this.sortableSelector
                }) : !1
            },
            updateSorting: function(event, ui) {
                var self;
                return vc_user_access().shortcodeAll("vc_tta_section_team_slider") ? (self = this, this.$sortable.find(this.sortableSelector).each(function() {
                    var shortcode, modelId, $this;
                    $this = $(this), modelId = $this.attr(self.sortableUpdateModelIdSelector), shortcode = vc.shortcodes.get(modelId), vc.storage.lock(), shortcode.save({
                        order: self.getIndex($this)
                    })
                }), vc.storage.unlock(), void vc.storage.save()) : !1
            },
            makeFirstSectionActive: function() {
                this.$content.children(":first-child").addClass(this.activeClass)
            },
            checkForActiveSection: function() {
                var $currentActive;
                $currentActive = this.$content.children("." + this.activeClass), $currentActive.length || this.makeFirstSectionActive()
            },
            changeActiveSection: function(modelId) {
                this.$content.children(".vc_tta-panel." + this.activeClass).removeClass(this.activeClass), this.findSection(modelId).addClass(this.activeClass)
            },
            changedContent: function(view) {
                var changedContent;
                return changedContent = window.VcBackendTtaViewInterface.__super__.changedContent.call(this, view), this.checkForActiveSection(), this.buildSortable(this.$sortable), changedContent
            },
            notifySectionChanged: function(model) {
                var view, title;
                view = model.get("view"), _.isObject(view) && (title = model.getParam("title"), _.isString(title) && title.length || (title = this.defaultSectionTitle), view.$el.find(".vc_tta-panel-title a .vc_tta-title-text").text(title))
            },
            notifySectionRendered: function(model) {},
            getNextTab: function($viewTab) {
                var lastIndex, viewTabIndex, $nextTab, $navigationSections;
                return $navigationSections = this.$navigation.children(), lastIndex = $navigationSections.length - 2, viewTabIndex = $viewTab.index(), $nextTab = viewTabIndex !== lastIndex ? $navigationSections.eq(viewTabIndex + 1) : $navigationSections.eq(viewTabIndex - 1)
            },
            renderSortingPlaceholder: function(event, element) {
                return vc.app.renderPlaceholder(event, element)
            }
        });

window.VcBackendTtaAccordionTeamSliderView = VcBackendTtaViewInterface.extend({
            sortableSelector: "> .vc_tta-panel:not(.vc_tta-section-append)",
            sortableSelectorCancel: ".vc-non-draggable",
            sortableUpdateModelIdSelector: "data-model-id",
            defaultSectionTitle: window.i18nLocale.section,
            render: function() {
                return window.VcBackendTtaTabsView.__super__.render.call(this), this.$navigation = this.$content, this.$sortable = this.$content, vc_user_access().shortcodeAll("vc_tta_section_team_slider") || this.$content.find(".vc_tta-section-append").hide(), this
            },
            removeSection: function(model) {
                var $viewTab, $nextTab, tabIsActive;
                $viewTab = this.findSection(model.get("id")), tabIsActive = $viewTab.hasClass(this.activeClass), tabIsActive && ($nextTab = this.getNextTab($viewTab), $nextTab.addClass(this.activeClass))
            },
            addShortcode: function(view) {
                var beforeShortcode;
                beforeShortcode = _.last(vc.shortcodes.filter(function(shortcode) {
                    return shortcode.get("parent_id") === this.get("parent_id") && parseFloat(shortcode.get("order")) < parseFloat(this.get("order"))
                }, view.model)), beforeShortcode ? view.render().$el.insertAfter("[data-model-id=" + beforeShortcode.id + "]") : this.$content.prepend(view.render().el)
            }
        });
		