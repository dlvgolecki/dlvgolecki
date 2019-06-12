<?php

$adobefonts_fonts = NorebroSettings::get('adobekit_fonts', 'global');
$norebro_gf_object = '{"items": [';
if (!empty($adobefonts_fonts) && is_array($adobefonts_fonts)) { $i = 0;
    foreach ($adobefonts_fonts as $adobefonts_font) { $i++;
        $norebro_gf_object .= '
            {
                "family": "'.$adobefonts_font['font_family'].'",
                "variants": [ ';
        if (!empty($adobefonts_font['font_styles']) && is_array($adobefonts_font['font_styles'])) {
            $j = 0;
            foreach ($adobefonts_font['font_styles'] as $font_style) { $j++;
                $norebro_gf_object .= '"'.$font_style.'"';
                if ($j != count($adobefonts_font['font_styles'])) {
                    $norebro_gf_object .= ',';
                }

            }
        }
        $norebro_gf_object .= ' ],
                "subsets": [ "latin" ]
            }';
        if ($i != count($adobefonts_fonts)) {
            $norebro_gf_object .= ',';
        }
    }
}
$norebro_gf_object .= ']}';


$norebro_gf_object = json_decode( $norebro_gf_object );

