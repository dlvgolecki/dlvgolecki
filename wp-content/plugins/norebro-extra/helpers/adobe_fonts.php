<?php

class NorExtraAdobeFonts {

    static public function get_abobe_fonts_array() {

        $adobefonts_fonts = NorebroSettings::get('adobekit_fonts', 'global');
        $norebro_gf_list = '[';
        if (!empty($adobefonts_fonts) && is_array($adobefonts_fonts)) { $i = 0;
            foreach ($adobefonts_fonts as $adobefonts_font) { $i++;
                $norebro_gf_list .= '
            {
                "font_family": "'.$adobefonts_font['font_family'].'",
                "font_styles": "';
                if (!empty($adobefonts_font['font_styles']) && is_array($adobefonts_font['font_styles'])) {
                    $j = 0;
                    foreach ($adobefonts_font['font_styles'] as $font_style) { $j++;
                        $norebro_gf_list .= $font_style;
                        if ($j != count($adobefonts_font['font_styles'])) {
                            $norebro_gf_list .= ',';
                        }

                    }
                }
                $norebro_gf_list .= ' "
            }';
                if ($i != count($adobefonts_fonts)) {
                    $norebro_gf_list .= ',';
                }
            }
        }
        $norebro_gf_list .= ']';


        return json_decode( $norebro_gf_list );
    }
}