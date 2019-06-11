<?php
/* ==============================================
  Try to remove default template
=============================================== */
add_filter( 'vc_load_default_templates', 'elston_template_modify_array' );
function elston_template_modify_array($data) {
    return array(); // This will remove all default templates
}

/* ==============================================
  Create Custom Template in Visual Composer
=============================================== */

/* Portfolio - Masonry */
add_filter( 'vc_load_default_templates', 'vc_portfolio_masonry_page' );
function vc_portfolio_masonry_page($data) {
	$template               = array();
	$template['name']       = __( 'Portfolio - Masonry', 'elston-core' );
	$template['content']    = <<<CONTENT
[vc_row][vc_column][elstn_portfolio style="masonry" blog_col="col-item-4" blog_order="ASC" blog_orderby="date" pagination="yes" pagination_type="ajax" posts_per_page="12"][/vc_column][/vc_row]
CONTENT;
	array_unshift($data, $template);
	return $data;
}

/* Portfolio - Wide */
add_filter( 'vc_load_default_templates', 'vc_portfolio_wide_page' );
function vc_portfolio_wide_page($data) {
	$template               = array();
	$template['name']       = __( 'Portfolio - Wide', 'elston-core' );
	$template['content']    = <<<CONTENT
[vc_row overlay_dotted=""][vc_column][elstn_portfolio style="wide" banner_title="Hi, Stranger!" banner_subtitle="we are elston studio." banner_link_text="View Case Studies"][/vc_column][/vc_row]
CONTENT;
	array_unshift($data, $template);
	return $data;
}

/* Portfolio - Home */
add_filter( 'vc_load_default_templates', 'vc_portfolio_page' );
function vc_portfolio_page($data) {
	$template               = array();
	$template['name']       = __( 'Portfolio - Home', 'elston-core' );
	$template['content']    = <<<CONTENT
[vc_row][vc_column][elstn_portfolio blog_col="col-item-4" blog_order="ASC" blog_orderby="date" pagination="yes" pagination_type="ajax" posts_per_page="12"][/vc_column][/vc_row]
CONTENT;
	array_unshift($data, $template);
	return $data;
}

/* Services */
add_filter( 'vc_load_default_templates', 'vc_services_page' );
function vc_services_page($data) {
	$template               = array();
	$template['name']       = __( 'Services', 'elston-core' );
	$template['content']    = <<<CONTENT
[vc_row overlay_dotted="" css=".vc_custom_1488820462159{background-position: center !important;background-repeat: no-repeat !important;background-size: cover !important;}"][vc_column el_class="white-color"][elstn_banner type="parallax" parallax_type="text" text_color="#232323" bg_image="159"]
<h1>We’re crafting digital
experience</h1>
<h4>We are absolutely passionate about simple yet sophisticated
design that we, and our clients, are proud of.</h4>
[/elstn_banner][/vc_column][/vc_row][vc_row overlay_dotted="" el_class="elstn-services" css=".vc_custom_1478417934154{background-color: #f7f8f9 !important;}"][vc_column][vc_row_inner equal_height="yes" content_placement="middle"][vc_column_inner width="1/2"][vc_single_image img_size="585x320" alignment="center"][/vc_column_inner][vc_column_inner width="1/2"][elstn_service_info title="Web Development" type="single" icon="icon-screen-desktop"]Appropriately empower dynamic leadership skills after business portals. Globally myocardinate interactive supply chains with distinctive quality vectors. .[/elstn_service_info][/vc_column_inner][/vc_row_inner][vc_row_inner equal_height="yes" content_placement="middle"][vc_column_inner width="1/2"][elstn_service_info title="Branding &amp; Identity" type="single" icon="icon-film"]Distinctively exploit optimal alignments for intuitive bandwidth. Quickly coordinate e-business applications through revolutionary catalysts for change. [/elstn_service_info][/vc_column_inner][vc_column_inner width="1/2"][vc_single_image img_size="585x320" alignment="center"][/vc_column_inner][/vc_row_inner][vc_row_inner equal_height="yes" content_placement="middle" el_class="container service-item"][vc_column_inner width="1/2"][vc_single_image img_size="585x320" alignment="center"][/vc_column_inner][vc_column_inner width="1/2"][elstn_service_info title="Product Design" type="single" icon="icon-picture"]Efficiently enable enabled sources and cost effective products. Completely synthesize principle-centered information after ethical communities. [/elstn_service_info][/vc_column_inner][/vc_row_inner][/vc_column][/vc_row]
CONTENT;
	array_unshift($data, $template);
	return $data;
}

/* Journal Modern */
add_filter( 'vc_load_default_templates', 'vc_journal_modern' );
function vc_journal_modern($data) {
	$template               = array();
	$template['name']       = __( 'Journal Modern', 'elston-core' );
	$template['content']    = <<<CONTENT
[vc_row][vc_column][elstn_blog blog_style="modern" blog_limit="9" mts_opt="" blog_category="" blog_date="" blog_pagination="ajax"][/vc_column][/vc_row]
CONTENT;
	array_unshift($data, $template);
	return $data;
}

/* Contact */
add_filter( 'vc_load_default_templates', 'vc_contact_page' );
function vc_contact_page($data) {
	$template               = array();
	$template['name']       = __( 'Contact', 'elston-core' );
	$template['content']    = <<<CONTENT
[vc_row][vc_column][elstn_gmap gmap_api="AIzaSyCLTiri5Wuym_9VNHlkRS3I88HD-wP7dsk" gmap_scroll_wheel="" gmap_street_view="" gmap_maptype_control="" locations="%5B%7B%22latitude%22%3A%22-28.016667%22%2C%22longitude%22%3A%22153.400000%22%7D%5D"][/vc_column][/vc_row][vc_row overlay_dotted="" el_class="container" css=".vc_custom_1478375621992{padding-top: 100px !important;padding-bottom: 90px !important;}"][vc_column width="1/3" css=".vc_custom_1488697517715{padding-right: 15px !important;padding-left: 15px !important;}"][elstn_contact_list contact_title="Contact Us"]Write us an e-mail via the form,
or just send us an e-mail directly at
<a href="mailto:infoatvictorthemes.com">info[at]victorthemes.com</a>

[elston_phone phone="+(323)432 56 3423" phone_link="+323432563423"][elston_phone phone="+(323)432 56 5149" phone_link="+323432565149"][/elstn_contact_list][elstn_contact_list contact_title="Our Address"]Elston LLC
Lexington Ave 549MD,
London, UK[/elstn_contact_list][/vc_column][vc_column width="2/3" css=".vc_custom_1488697524634{padding-right: 15px !important;padding-left: 15px !important;}"][vc_column_text]
<h3>Drop a line</h3>
[/vc_column_text][contact-form-7 id="5"][/vc_column][/vc_row][vc_row overlay_dotted="" css=".vc_custom_1488820369248{background-position: center !important;background-repeat: no-repeat !important;background-size: cover !important;}"][vc_column][elstn_social_list_icons list_items="%5B%7B%22select_icon%22%3A%22fa%20fa-twitter%22%2C%22link%22%3A%22http%3A%2F%2Ftwitter.com%22%7D%2C%7B%22select_icon%22%3A%22fa%20fa-facebook-official%22%2C%22link%22%3A%22http%3A%2F%2Ffacebook.com%22%7D%2C%7B%22select_icon%22%3A%22fa%20fa-dribbble%22%2C%22link%22%3A%22http%3A%2F%2Fdribbble.com%22%7D%2C%7B%22select_icon%22%3A%22fa%20fa-linkedin%22%2C%22link%22%3A%22http%3A%2F%2Flinkedin.com%22%7D%2C%7B%22select_icon%22%3A%22fa%20fa-instagram%22%2C%22link%22%3A%22http%3A%2F%2Finstagram.com%22%7D%5D" open_link="true" text_hover_color="#c7ac75" title="" css=""][/vc_column][/vc_row]
CONTENT;
	array_unshift($data, $template);
	return $data;
}

/* About Studio */
add_filter( 'vc_load_default_templates', 'vc_about_studio_page' );
function vc_about_studio_page($data) {
	$template               = array();
	$template['name']       = __( 'About Studio', 'elston-core' );
	$template['content']    = <<<CONTENT
[vc_row overlay_dotted="" css=".vc_custom_1488820225072{background-position: center !important;background-repeat: no-repeat !important;background-size: cover !important;}"][vc_column][elstn_banner type="parallax" parallax_type="text" text_color="#232323" bg_image="115"]
<h1>We’re elston studio based
out of london UK.</h1>
<h4>Created by award winning design team. You can use this
awesome section to sell yourself.</h4>
[/elstn_banner][/vc_column][/vc_row][vc_row][vc_column][vc_tabs][vc_tab title="Vision" tab_id="1478499212-1-55"][vc_column_text]Appropriately empower dynamic leadership after business portal. Globally cardinate Efficiently initiate world-class applications after client-centric infomediaries. interactive supply chains with distinctive quality vectors.revolutionize Globally  global sources through interoperable services.[/vc_column_text][/vc_tab][vc_tab title="Mission" tab_id="1478499212-2-17"][vc_column_text]Distinctively re-engineer revolutionary meta-services and premium architectures. Intrinsically incubateEfficiently initiate world-class applications after client-centric infomediaries. intuitive opportunities and real-time potentialities. technology after plug-and-play networks.[/vc_column_text][/vc_tab][vc_tab title="Approach" tab_id="1478499212-3-23"][vc_column_text]Synergistically evolve 2.0 technologies rather than just in time initiatives. Quickly deploy strategic networks with compelling e-business. Efficiently initiate world-class applications. Credibly pontificate highly efficient manufactured products and enabled data.[/vc_column_text][/vc_tab][/vc_tabs][/vc_column][/vc_row][vc_row][vc_column][elstn_team team_limit="4" team_order="ASC"][/vc_column][/vc_row][vc_row overlay_dotted="" el_class="elstn-services-group"][vc_column width="1/2"][elstn_service_info title="Focus on one thing" type="group" icon="icon-organization"]Distinctively re-engineer revolutionary meta-Basic services.[/elstn_service_info][elstn_service_info title="We Work Fast" type="group" icon="icon-support"]Enthusiastically mesh long-term high impact infrastructures.[/elstn_service_info][elstn_service_info title="Just-in-time expertise" type="group" icon="icon-fire"]Dynamically reinvent market driven opportunities and ubiquitous.[/elstn_service_info][/vc_column][vc_column width="1/2"][elstn_service_info title="Award winning" type="group" icon="icon-trophy"]Distinctively exploit alignments for intuitive optimal bandwidth.[/elstn_service_info][elstn_service_info title="Visually Seductive" type="group" icon="icon-film"]Interactively procrastinate high-payoff content without backward.[/elstn_service_info][elstn_service_info title="Reach us anytime" type="group" icon="icon-clock"]Bring to the table win-win survival strategies to domination.[/elstn_service_info][/vc_column][/vc_row][vc_row overlay_dotted=""][vc_column][elstn_testimonial item="4" testi_order="DESC" type="testi-bg"][/vc_column][/vc_row][vc_row][vc_column][elstn_clients loop=""][/vc_column][/vc_row][vc_row overlay_dotted="" css=".vc_custom_1488820691755{background-color: #232323 !important;background-position: center !important;background-repeat: no-repeat !important;background-size: cover !important;}"][vc_column][elstn_contact_banner title="Do you love our works?" text="Contact Us" btn_open_link="" btn_size="medium" btn_type="btn-two" btn_style="rounded" bg_img="122"][/vc_column][/vc_row]
CONTENT;
	array_unshift($data, $template);
	return $data;
}

/* About Me */
add_filter( 'vc_load_default_templates', 'vc_about_me_page' );
function vc_about_me_page($data) {
	$template               = array();
	$template['name']       = __( 'About Me', 'elston-core' );
	$template['content']    = <<<CONTENT
[vc_row][vc_column][elstn_about title="David Elston" sub_title="Graphical Designer" about_image_position="left" text="Elston@victorthemes.com" btn_open_link="" link="mailto:elston@victorthemes.com" btn_size="large" btn_type="btn-bg" btn_style="rounded"]
<h4>Any business in a competitive industy looking to increase rankings and traffic be would be mice to get in touch with auquire.</h4>
Progressively maintain extensive infomediaries via extensible niches. Dramatically disseminate standardized metrics after resource-leveling processes. Objectively pursue diverse catalysts for change for interoperable meta-services.Distinctively re-engineer revolutionary meta-services and premium architectures. Intrinsically incubate intuitive opportunities and real-time potentialities.

Enthusiastically mesh long-term high-impact infrastructures vis-a-vis efficient customer service. Professionally fashion wireless leadership rather than prospective experiences. Energistically myocardinate clicks-and-mortar testing procedures whereas manufactured products.[/elstn_about][/vc_column][/vc_row]
CONTENT;
	array_unshift($data, $template);
	return $data;
}

/* Single Portfolio - Right Full Width */
add_filter( 'vc_load_default_templates', 'vc_single_portfolio_right_fullwidth' );
function vc_single_portfolio_right_fullwidth($data) {
	$template               = array();
	$template['name']       = __( 'Single Portfolio - Right Full Width', 'elston-core' );
	$template['content']    = <<<CONTENT
[vc_row overlay_dotted=""][vc_column width="8/12" el_class="elstn-sidebar-image"][elstn_portfolio_image][elstn_portfolio_image][elstn_portfolio_image][/vc_column][vc_column width="4/12"][elstn_portfolio_details version="four" sub_heading="Branding, Design" link="https://themeforest.net/user/victorthemes/portfolio" open_link="true" link_text="www.victorthemes.com" detail_lists="%5B%7B%22title%22%3A%22Client%22%2C%22text_one%22%3A%22Will%20Turner%22%7D%2C%7B%22title%22%3A%22Year%22%2C%22text_one%22%3A%222016%22%7D%2C%7B%22title%22%3A%22Services%22%2C%22text_one%22%3A%22Branding%22%2C%22text_one_link%22%3A%22http%3A%2F%2Fvictorthemes.com%2Fthemes%2Felston%2Fportfolio-category_cat%2Fbranding%2F%22%2C%22text_two%22%3A%22Product%20Design%22%2C%22text_two_link%22%3A%22http%3A%2F%2Fvictorthemes.com%2Fthemes%2Felston%2Fportfolio-category_cat%2Fproduct-design%2F%22%7D%5D" share_on="true"]Proactively envisioned multimedia based expertise and cross-media growth strategies. Seamlessly visualize quality intellectual capital without superior collaboration and idea-sharing. Holistically pontificate installed base portals products.

Interactively procrastinate high-payoff content without backward-compatible data. Quickly cultivate optimal processes and tactical architectures.[/elstn_portfolio_details][/vc_column][/vc_row]
CONTENT;
	array_unshift($data, $template);
	return $data;
}

/* Single Portfolio - Left Full Width */
add_filter( 'vc_load_default_templates', 'vc_single_portfolio_left_fullwidth' );
function vc_single_portfolio_left_fullwidth($data) {
	$template               = array();
	$template['name']       = __( 'Single Portfolio - Left Full Width', 'elston-core' );
	$template['content']    = <<<CONTENT
[vc_row overlay_dotted=""][vc_column width="4/12"][elstn_portfolio_details version="three" sub_heading="Branding, Design" link="https://themeforest.net/user/victorthemes/portfolio" open_link="true" link_text="Buy this theme" detail_lists="%5B%7B%22title%22%3A%22Client%22%2C%22text_one%22%3A%22William%20Nickson%22%7D%2C%7B%22title%22%3A%22Year%22%2C%22text_one%22%3A%222016%22%7D%2C%7B%22title%22%3A%22Services%22%2C%22text_one%22%3A%22Design%20Arts%22%2C%22text_one_link%22%3A%22http%3A%2F%2Fvictorthemes.com%2Fthemes%2Felston%2Fportfolio-category_cat%2Fdesign-arts%2F%22%7D%5D" share_on="true"]Quickly communicate enabled technology and turnkey leadership skills. Uniquely enable the accurate supply chains rather than frictionless technology. Globally network focused material vis-a-vis cost effective manufactured products.

Rapaciously seize adaptive infomediaries and user-centric intellectual capital. Collaboratively unleash market-driven outside the box solutions.[/elstn_portfolio_details][/vc_column][vc_column width="8/12" el_class="elstn-sidebar-image"][elstn_portfolio_image][elstn_portfolio_image][elstn_portfolio_image][elstn_portfolio_image][/vc_column][/vc_row]
CONTENT;
	array_unshift($data, $template);
	return $data;
}

/* Single Portfolio - Right Boxed */
add_filter( 'vc_load_default_templates', 'vc_single_portfolio_right_boxed' );
function vc_single_portfolio_right_boxed($data) {
	$template               = array();
	$template['name']       = __( 'Single Portfolio - Right Boxed', 'elston-core' );
	$template['content']    = <<<CONTENT
[vc_row][vc_column width="4/12"][elstn_portfolio_details version="four" sidebar_style="floting" sub_heading="Printing &amp; Packaging" link="https://themeforest.net/user/victorthemes/portfolio" open_link="true" link_text="Purchase Now" detail_lists="%5B%7B%22title%22%3A%22Client%22%2C%22text_one%22%3A%22Martin%20Vein%22%7D%2C%7B%22title%22%3A%22Year%22%2C%22text_one%22%3A%222016%22%7D%2C%7B%22title%22%3A%22Services%22%2C%22text_one%22%3A%22Branding%22%2C%22text_one_link%22%3A%22http%3A%2F%2Fvictorthemes.com%2Fthemes%2Felston%2Fportfolio-category_cat%2Fbranding%2F%22%2C%22text_two%22%3A%22Entertainment%22%2C%22text_two_link%22%3A%22http%3A%2F%2Fvictorthemes.com%2Fthemes%2Felston%2Fportfolio-category_cat%2Fentertainment%2F%22%7D%5D" share_on="true"]Appropriately empower dynamic leadership skills after business portals. Globally myocard interactive supply chains with distinct quality vectors. Globally revolution global sources through interoperable services. Quickly to aggregate potentialities.

Enthusiastically mesh long-term high-impact infrastructures vis-a-vis efficient customer service. Professionally fashion wireless leadership.[/elstn_portfolio_details][/vc_column][vc_column width="8/12"][elstn_portfolio_image popup_type="popup_modern"][elstn_portfolio_image popup_type="popup_modern"][elstn_portfolio_image popup_type="popup_modern"][elstn_portfolio_image popup_type="popup_modern"][/vc_column][/vc_row]
CONTENT;
	array_unshift($data, $template);
	return $data;
}

/* Single Portfolio - Left Boxed */
add_filter( 'vc_load_default_templates', 'vc_single_portfolio_left_boxed' );
function vc_single_portfolio_left_boxed($data) {
  $template               = array();
  $template['name']       = __( 'Single Portfolio - Left Boxed', 'elston-core' );
  $template['content']    = <<<CONTENT
[vc_row][vc_column width="8/12" el_class="elstn-sidebar-image"][elstn_portfolio_image popup_type="popup_modern"][elstn_portfolio_image][elstn_portfolio_image][elstn_portfolio_image][/vc_column][vc_column width="4/12"][elstn_portfolio_details version="four" sidebar_style="floting" sub_heading="Printing &amp; Packaging" link="https://themeforest.net/user/victorthemes/portfolio" open_link="true" link_text="Visit Website" detail_lists="%5B%7B%22title%22%3A%22Client%22%2C%22text_one%22%3A%22Jack%20Sparrow%22%7D%2C%7B%22title%22%3A%22Year%22%2C%22text_one%22%3A%222016%22%7D%2C%7B%22title%22%3A%22Services%22%2C%22text_one%22%3A%22Design%20Arts%22%2C%22text_one_link%22%3A%22http%3A%2F%2Fvictorthemes.com%2Fthemes%2Felston%2Fportfolio-category_cat%2Fdesign-arts%2F%22%2C%22text_two%22%3A%22Entertainment%22%2C%22text_two_link%22%3A%22http%3A%2F%2Fvictorthemes.com%2Fthemes%2Felston%2Fportfolio-category_cat%2Fentertainment%2F%22%7D%5D" share_on="true"]Podcasting operational change management inside of workflows to establish a framework. Taking seamless key performance indicators offline to maximise the long tail. Keeping your eye on the ball while performing a deep dive on the start- integration.

Efficiently unleash cross-media information without cross-media value. Quickly maximize timely deliverables for real-time schemas.[/elstn_portfolio_details][/vc_column][/vc_row]
CONTENT;
  array_unshift($data, $template);
  return $data;
}

/* Single Portfolio - Full Width - Six */
add_filter( 'vc_load_default_templates', 'vc_single_portfolio_fullwidth_six' );
function vc_single_portfolio_fullwidth_six($data) {
    $template               = array();
    $template['name']       = __( 'Single Portfolio - Full Width - Six', 'elston-core' );
    $template['content']    = <<<CONTENT
[vc_row][vc_column][elstn_portfolio_image][elstn_portfolio_details version="six" open_link="true" detail_lists="%5B%7B%22title%22%3A%22Client%22%2C%22text_one%22%3A%22Jack%20Martin%22%7D%2C%7B%22title%22%3A%22Year%22%2C%22text_one%22%3A%222016%22%7D%2C%7B%22title%22%3A%22Skills%22%2C%22text_one%22%3A%22Entertainment%22%2C%22text_one_link%22%3A%22http%3A%2F%2Fvictorthemes.com%2Fthemes%2Felston%2Fportfolio-category_cat%2Fentertainment%2F%22%2C%22text_two%22%3A%22Product%20Design%22%2C%22text_two_link%22%3A%22http%3A%2F%2Fvictorthemes.com%2Fthemes%2Felston%2Fportfolio-category_cat%2Fproduct-design%2F%22%7D%5D"]
<h4>Challenge</h4>
Efficiently enable enabled sources and cost effective products. Completely synthesize principle-centered information after ethical communities. Efficiently innovate open-source infrastructures via inexpensive materials. quality vectors.

&nbsp;
<h4>Solution</h4>
Quickly communicate enabled technology and turnkey leadership skills. Uniquely enable accurate supply chains rather than frictionless technology.

&nbsp;
<h4>Result</h4>
Efficiently myocardinate market-driven innovation via open-source alignments.[/elstn_portfolio_details][elstn_portfolio_image][elstn_testimonial item="1"][elstn_portfolio_image][elstn_social_share][/vc_column][/vc_row]
CONTENT;
    array_unshift($data, $template);
    return $data;
}

/* Single Portfolio - Full Width - Five */
add_filter( 'vc_load_default_templates', 'vc_single_portfolio_fullwidth_five' );
function vc_single_portfolio_fullwidth_five($data) {
    $template               = array();
    $template['name']       = __( 'Single Portfolio - Full Width - Five', 'elston-core' );
    $template['content']    = <<<CONTENT
[vc_row][vc_column][elstn_portfolio_image][elstn_portfolio_details version="two" link="https://themeforest.net/user/victorthemes/portfolio" open_link="true" link_text="www.victorthemes.com" link_before_text="Visit Website :" client="Jacson Smith" detail_lists="%5B%7B%22title%22%3A%22Client%22%2C%22text_one%22%3A%22Jason%20Smith%22%7D%2C%7B%22title%22%3A%22Services%22%2C%22text_one%22%3A%22Art%20Design%22%2C%22text_one_link%22%3A%22http%3A%2F%2Fwww.artanddesignhs.com%2F%22%2C%22text_two%22%3A%22Illustrator%22%2C%22text_two_link%22%3A%22http%3A%2F%2Fwww.adobe.com%2Fin%2Fproducts%2Fillustrator.html%22%7D%5D"]Appropriately empower dynamic leadership skills after business portals. Globally myocardinate interactive supply chains with distinctive quality vectors. Globally revolutionize global sources through services. leveling e-commerce[/elstn_portfolio_details][vc_video link="https://vimeo.com/29372689"][vc_row_inner][vc_column_inner width="1/3"][vc_column_text]
<h4><strong>Case Study</strong></h4>
Leverage agile frameworks to provide a robust synopsis for high level overviews. Iterative approaches to corporate strategy.[/vc_column_text][/vc_column_inner][vc_column_inner width="1/3"][vc_column_text]
<h4>Result</h4>
Bring to the table win-win survival strategies to ensure proactive domination. At the end of the day, going forward a new normal.[/vc_column_text][/vc_column_inner][vc_column_inner width="1/3"][vc_column_text]
<h4>Experience</h4>
Capitalize on low hanging fruit to identify a ballpark value added activity to beta test. Override the digital divide.[/vc_column_text][/vc_column_inner][/vc_row_inner][vc_empty_space height="100px"][elstn_portfolio_image][elstn_social_share][/vc_column][/vc_row]
CONTENT;
    array_unshift($data, $template);
    return $data;
}

/* Single Portfolio - Full Width - Four */
add_filter( 'vc_load_default_templates', 'vc_single_portfolio_fullwidth_four' );
function vc_single_portfolio_fullwidth_four($data) {
    $template               = array();
    $template['name']       = __( 'Single Portfolio - Full Width - Four', 'elston-core' );
    $template['content']    = <<<CONTENT
[vc_row full_width="stretch_row_content_no_spaces" overlay_dotted=""][vc_column][vc_single_image img_size="full"][/vc_column][/vc_row][vc_row][vc_column][elstn_portfolio_details sub_heading="Trendy Stationary Presentation Mockup" link="https://themeforest.net/user/victorthemes/portfolio" open_link="true" link_text="Download here." link_before_text="Available for "]Interactively procrastinate high-payoff content without backward-compatible data. Quickly cultivate optimal processes and tactical architectures. Completely iterate covalent strategic theme areas via accurate e-markets. Distinctively exploit optimal alignments for intuitive bandwidth.[/elstn_portfolio_details][elstn_portfolio_image][vc_empty_space height="30px"][elstn_portfolio_image][elstn_social_share][/vc_column][/vc_row]
CONTENT;
    array_unshift($data, $template);
    return $data;
}

/* Single Portfolio - Full Width - Three */
add_filter( 'vc_load_default_templates', 'vc_single_portfolio_fullwidth_three' );
function vc_single_portfolio_fullwidth_three($data) {
		$template               = array();
		$template['name']       = __( 'Single Portfolio - Full Width - Three', 'elston-core' );
		$template['content']    = <<<CONTENT
[vc_row][vc_column][elstn_portfolio_details sub_heading="Grand Stationary Presentation Mockup" link="https://themeforest.net/user/victorthemes/portfolio" open_link="true" link_text="Purchase Now." link_before_text="Available for "]Rapaciously seize adaptive infomediaries and user-centric intellectual capital. Collaboratively unleash market-driven "outside the box" thinking for long-term high-impact solutions.[/elstn_portfolio_details][elstn_social_share][/vc_column][/vc_row][vc_row overlay_dotted="" css=".vc_custom_1478446040783{padding-top: 78px !important;padding-bottom: 70px !important;}"][vc_column text_alignment="text-center"][vc_column_text]
<h3>Chair Variety</h3>
[/vc_column_text][vc_empty_space height="114px"][vc_row_inner][vc_column_inner width="1/3"][elstn_portfolio_image popup_type="popup_modern"][/vc_column_inner][vc_column_inner width="1/3"][elstn_portfolio_image popup_type="popup_modern"][/vc_column_inner][vc_column_inner width="1/3"][elstn_portfolio_image popup_type="popup_modern"][/vc_column_inner][/vc_row_inner][/vc_column][/vc_row][vc_row overlay_dotted="" css=".vc_custom_1478446084847{padding-top: 72px !important;padding-bottom: 70px !important;}"][vc_column text_alignment="text-center"][vc_column_text]
<h3>Stool Variety</h3>
[/vc_column_text][vc_empty_space height="114px"][vc_row_inner][vc_column_inner width="1/4"][elstn_portfolio_image popup_type="popup_modern"][/vc_column_inner][vc_column_inner width="1/4"][elstn_portfolio_image popup_type="popup_modern"][/vc_column_inner][vc_column_inner width="1/4"][elstn_portfolio_image popup_type="popup_modern"][/vc_column_inner][vc_column_inner width="1/4"][elstn_portfolio_image popup_type="popup_modern"][/vc_column_inner][/vc_row_inner][/vc_column][/vc_row][vc_row overlay_dotted="" css=".vc_custom_1478446133710{padding-top: 72px !important;padding-bottom: 70px !important;}"][vc_column text_alignment="text-center"][vc_column_text]
<h3>Chair-2 Variety</h3>
[/vc_column_text][vc_empty_space height="114px"][vc_row_inner][vc_column_inner width="1/2"][elstn_portfolio_image popup_type="popup_modern"][/vc_column_inner][vc_column_inner width="1/2"][elstn_portfolio_image popup_type="popup_modern"][/vc_column_inner][/vc_row_inner][/vc_column][/vc_row]
CONTENT;
    array_unshift($data, $template);
    return $data;
}

/* Single Portfolio - Full Width - Two */
add_filter( 'vc_load_default_templates', 'vc_single_portfolio_fullwidth_two' );
function vc_single_portfolio_fullwidth_two($data) {
    $template               = array();
    $template['name']       = __( 'Single Portfolio - Full Width - Two', 'elston-core' );
    $template['content']    = <<<CONTENT
[vc_row][vc_column][elstn_portfolio_details sub_heading="Grand Stationary Presentation Mockup" link="https://themeforest.net/user/victorthemes/portfolio" open_link="true" link_text="Purchase Now"]Objectively integrate enterprise-wide strategic theme areas with functionalized infrastructures. Interactively productize premium technologies whereas interdependent quality vectors. Rapaciously utilize enterprise experiences via 24/7 markets. Uniquely matrix economically sound value.[/elstn_portfolio_details][/vc_column][/vc_row][vc_row][vc_column width="1/2" offset="vc_col-lg-6 vc_col-md-12 vc_col-xs-12" css=".vc_custom_1487064226532{padding-right: 10px !important;padding-left: 10px !important;}"][elstn_portfolio_image type="p_gal" title="Mac Mini 2014"][vc_empty_space height="20"][/vc_column][vc_column width="1/2" offset="vc_col-lg-6 vc_col-md-12 vc_col-xs-12" css=".vc_custom_1487064231605{padding-right: 10px !important;padding-left: 10px !important;}"][elstn_portfolio_image type="p_gal" title="Mac Mini Cross"][vc_empty_space height="20"][/vc_column][/vc_row][vc_row][vc_column width="5/12" css=".vc_custom_1487064206805{padding-right: 10px !important;padding-left: 10px !important;}"][elstn_portfolio_image type="p_gal" title="Black Lenght Pendrive" class="height-pendrive"][/vc_column][vc_column width="7/12" css=".vc_custom_1487064216717{padding-right: 10px !important;padding-left: 10px !important;}"][vc_row_inner][vc_column_inner width="1/2" css=".vc_custom_1487064516240{padding-right: 8px !important;padding-left: 12px !important;}"][elstn_portfolio_image type="p_gal" title="Black Foldable Pendrive"][vc_empty_space height="20"][elstn_portfolio_image type="p_gal" title="Pen Drive Slide Type"][/vc_column_inner][vc_column_inner width="1/2" css=".vc_custom_1487064441047{padding-right: 12px !important;padding-left: 8px !important;}"][elstn_portfolio_image type="p_gal" title="Pen Drive with Cap"][vc_empty_space height="20"][elstn_portfolio_image type="p_gal" title="Black Foldable Pendrive"][/vc_column_inner][/vc_row_inner][/vc_column][/vc_row][vc_row][vc_column][elstn_social_share][/vc_column][/vc_row]
CONTENT;
    array_unshift($data, $template);
    return $data;
}

/* Single Portfolio - Full Width - One */
add_filter( 'vc_load_default_templates', 'vc_single_portfolio_fullwidth_one' );
function vc_single_portfolio_fullwidth_one($data) {
    $template               = array();
    $template['name']       = __( 'Single Portfolio - Full Width - One', 'elston-core' );
    $template['content']    = <<<CONTENT
[vc_row][vc_column][elstn_portfolio_image][elstn_portfolio_details sub_heading="Trendy Minimal T-shirt Mockup" link="https://themeforest.net/user/victorthemes/portfolio" open_link="true" link_text="View Website Here" class="version2"]Quickly communicate enabled technology and turnkey leadership skills. Uniquely enable accurate supply chains rather than frictionless technology. Globally network focused materials vis-a-vis cost effective manufactured products. Enthusiastically leverage existing premium quality vectors.[/elstn_portfolio_details][/vc_column][/vc_row][vc_row equal_height="yes" content_placement="middle" overlay_dotted="" el_class="margin-no padding-no" css=".vc_custom_1478043694378{background-color: #ffffff !important;}"][vc_column width="1/2"][vc_single_image img_size="586x420"][/vc_column][vc_column width="1/2"][elstn_target_info title="Challenge"]<span style="font-size: 16px;"><em>"Leverage agile frameworks to provide a robust synopsis for high level overviews. Approaches to  further the overall value proposition".</em></span>

<span style="color: #000000; font-size: 17px;"><strong>-austin agar</strong></span>[/elstn_target_info][/vc_column][/vc_row][vc_row equal_height="yes" content_placement="middle" overlay_dotted="" el_class="margin-no padding-no" css=".vc_custom_1478043702486{background-color: #ffffff !important;}"][vc_column width="1/2"][elstn_target_info title="Solution"]Objectively integrate enterprise-wide strategic theme areas with functionalized infrastructures. Interactively productize premium technologies whereas interdependent quality vectors.

Efficiently enable enabled sources and cost effective products. Completely synthesize principle.[/elstn_target_info][/vc_column][vc_column width="1/2"][vc_single_image img_size="586x420"][/vc_column][/vc_row][vc_row equal_height="yes" content_placement="middle" overlay_dotted="" el_class="margin-no padding-no" css=".vc_custom_1478043710053{background-color: #ffffff !important;}"][vc_column width="1/2"][vc_single_image img_size="586x420"][/vc_column][vc_column width="1/2"][elstn_target_info title="Result"]Dynamically reinvent market-driven opportunities and ubiquitous interfaces. Energistically fabricate an expanded array of niche markets through robust products. Appropriately implement visionary e-services vis-a-vis strategic web-readiness.[/elstn_target_info][/vc_column][/vc_row][vc_row][vc_column][vc_empty_space height="40px"][elstn_social_share][/vc_column][/vc_row]
CONTENT;
    array_unshift($data, $template);
    return $data;
}

/* Single Post One */
add_filter( 'vc_load_default_templates', 'vc_single_post_one' );
function vc_single_post_one($data) {
    $template               = array();
    $template['name']       = __( 'Single Post One', 'elston-core' );
    $template['content']    = <<<CONTENT
[vc_row][vc_column][vc_column_text]Leverage agile frameworks to provide a robust synopsis for high level overviews. Iterative approaches to corporate strategy foster collaborative thinking to further the overall value proposition. Organically grow the holistic world view of disruptive innovation via workplace diversity and empowerment.Bring to the table win-win survival strategies to ensure proactive domination. At the end of the day, going forward, a new normal that has evolved from generation X is on the runway heading towards a streamlined cloud solution.[/vc_column_text][/vc_column][/vc_row][vc_row][vc_column][vc_video link="https://vimeo.com/29372689"][/vc_column][/vc_row][vc_row][vc_column][vc_column_text]<span style="font-size: 22px; color: #232323;"><strong>Forde and Nicol</strong></span>

Quickly incentivize impactful action items before tactical collaboration and idea-sharing. Monotonically engage market-driven intellectual capital through wireless opportunities. Progressively network performance based services for functionalized testing procedures.

<span style="font-size: 18px; color: #232323;"><strong>Challenge</strong></span>

Leverage agile frameworks to provide a robust synopsis for high level overviews. Iterative approaches to corporate strategy foster collaborative thinking to further the overall value proposition. Organically grow the holistic world view of disruptive innovation via workplace diversity and empowerment.

<span style="font-size: 18px; color: #232323;"><strong>Instructions</strong></span>

Podcasting operational change management inside of workflows to establish a framework. Taking seamless key performance indicators offline to maximise the long tail. Keeping your eye on the ball while performing a deep dive on the start-up mentality to derive convergence on cross-platform integration.

Efficiently unleash cross-media information without cross-media value. Quickly maximize timely deliverables for real-time schemas. Dramatically maintain clicks-and-mortar solutions without functional solutions.

Phosfluorescently engage worldwide methodologies with web-enabled technology. Interactively coordinate proactive e-commerce via process-centric "outside the box" thinking. Completely pursue scalable customer service through sustainable potentialities.

<span style="font-size: 18px; color: #232323;"><strong>The Result</strong></span>

Interactively procrastinate high-payoff content without backward-compatible data. Quickly cultivate optimal processes and tactical architectures. Completely iterate covalent strategic theme areas via accurate e-markets.

Distinctively exploit optimal alignments for intuitive bandwidth. Quickly coordinate e-business applications through revolutionary catalysts for change. Seamlessly underwhelm optimal testing procedures whereas bricks-and-clicks processes.[/vc_column_text][/vc_column][/vc_row]
CONTENT;
    array_unshift($data, $template);
    return $data;
}

/* Single Post Two */
add_filter( 'vc_load_default_templates', 'vc_single_post_two' );
function vc_single_post_two($data) {
    $template               = array();
    $template['name']       = __( 'Single Post Two', 'elston-core' );
    $template['content']    = <<<CONTENT
[vc_row][vc_column][vc_column_text]Leverage agile frameworks to provide a robust synopsis for high level overviews. Iterative approaches to corporate strategy foster collaborative thinking to further the overall value proposition. Organically grow the holistic world view of disruptive innovation via workplace diversity and empowerment.Bring to the table win-win survival strategies to ensure proactive domination. At the end of the day, going forward, a new normal that has evolved from generation X is on the runway heading towards a streamlined cloud solution.
<h4><span style="color: #232323;">Check the video</span></h4>
Capitalize on low hanging fruit to identify a ballpark value added activity to beta test. Override the digital divide with additional clickthroughs from DevOps.

Nanotechnology immersion along the information highway will close the loop on focusing solely on the bottom line.[/vc_column_text][vc_single_image img_size="749*430"][vc_column_text]
<h4><span style="color: #232323;">At a glance</span></h4>
Podcasting operational change management inside of workflows to establish a framework. Taking seamless key performance indicators offline to maximise the long tail. Keeping your eye on the ball while performing a deep dive on the start-up mentality to derive convergence on cross-platform integration.
<blockquote><span style="font-size: 22px;"><span style="color: #232323;"><em>"Creative without strategy is called 'art.' Creative with strategy is called Creative Agency."</em></span></span></blockquote>
Collaboratively administrate empowered markets via plug-and-play networks. Dynamically procrastinate B2C users after installed base benefits. Dramatically visualize customer directed convergence without revolutionary ROI.[/vc_column_text][vc_single_image img_size="749*430"][/vc_column][/vc_row][vc_row][vc_column][vc_column_text]
<h4><span style="color: #232323;">Where is Mobile</span></h4>
Completely synergize resource taxing relationships via premier niche markets. Professionally cultivate one-to-one customer service with robust ideas. Dynamically innovate resource-leveling customer service for state of the art customer service empowered manufactured products whereas parallel platforms.
<ul>
 	<li>Proactively multimedia based expertise and media growth strategies.</li>
 	<li>Seamlessly intellectual capital without superior collaboration and idea-sharing.</li>
 	<li>Holistically pontificate installed base portals after maintainable products with its creativity.</li>
</ul>
Collaboratively administrate turnkey channels whereas virtual e-tailers. Objectively seize scalable metrics whereas proactive e-services. Seamlessly empower fully researched growth strategies and interoperable internal or "organic" sources Credibly innovate granular internal or "organic" sources whereas high standards in web-readiness. Energistically scale future-proof core competencies vis-a-vis impactful experiences.[/vc_column_text][/vc_column][/vc_row]
CONTENT;
    array_unshift($data, $template);
    return $data;
}
