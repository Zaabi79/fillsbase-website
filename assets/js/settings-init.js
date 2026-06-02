"use strict"
localStorage.setItem('lng', 'en-US');
var optionSettings = {
    layout:"wide",
    background:"white",
    color:"pink",
    header:"",
    font:"opensans",
    textDirection:"ltr",
    radius:"sixradius",
    showSettings:"show",
};
try {
    new antlerSettings(optionSettings);
} catch(e) {
    console.warn('antlerSettings init skipped:', e.message);
}