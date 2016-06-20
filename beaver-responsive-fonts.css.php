/* ###########Small and up########## */
html {font-size: <?php echo $settings_min; ?>px !important;} /* minimum font size*/
h1 {
    font-size: <?php echo $settings_ratio['h1']; ?>rem !important;
    line-height: calc(<?php echo $settings_ratio['h1']; ?>rem * 1.5) !important;
}
h2 {font-size: <?php echo $settings_ratio['h2']; ?>rem  !important;
    line-height: calc(<?php echo $settings_ratio['h2']; ?>rem * 1.4) !important;
}
h3 {font-size: <?php echo $settings_ratio['h3']; ?>rem  !important;
    line-height: calc(<?php echo $settings_ratio['h3']; ?>rem * 1.3) !important;
}
h4 {font-size: <?php echo $settings_ratio['h4']; ?>rem  !important;
    line-height: calc(<?php echo $settings_ratio['h4']; ?>rem * 1.4) !important;
}
h5 {font-size: <?php echo $settings_ratio['h5']; ?>rem  !important;
        line-height: calc(<?php echo $settings_ratio['h5']; ?>rem * 1.4) !important;
}
h6 {font-size: <?php echo $settings_ratio['h6']; ?>rem  !important;
    line-height: calc(<?php echo $settings_ratio['h6']; ?>rem * 1.4) !important;
}
p {font-size: <?php echo $settings_ratio['p']; ?>rem  !important;
    line-height: calc(<?php echo $settings_ratio['p']; ?>rem * 1.4) !important;
}

/* ###########Medium and up########### */
@media screen and (min-width: 768px){
html {font-size: 2.0vw !important;}
/* ###########Large and Up########### */
@media screen and (min-width: 992px){
html {font-size: 1.6vw !important;}
}/* ##########Super Large And Up ############ */
@media screen and (min-width: 1400px){
html {font-size: <?php echo $settings_max; ?>px !important;}
}