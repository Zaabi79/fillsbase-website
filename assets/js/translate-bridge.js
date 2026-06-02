function applyTranslations(lng) {
    if (lng === 'en-US') {
        setCookie("language", "en-US", 7);
        // location.reload(); // Removed reload to see if live swap works better
    }
    
    $.getJSON('assets/locales/' + lng + '/translations.json', function(data) {
        if (!data) return;

        // 1. GLOBAL UI (Header, Menu, Footer)
        if (data.header) {
            $('.main-menu > li > a').each(function() {
                var t = $(this).text().trim();
                if (t.toLowerCase() === "home" || t.toLowerCase() === "casa") $(this).text(data.header.home);
                if (t.toLowerCase() === "hosting" || t.toLowerCase() === "alojamento") $(this).contents().filter(function(){return this.nodeType==3;}).first().replaceWith(data.header.services);
                if (t.toLowerCase() === "pages" || t.toLowerCase() === "paginas") $(this).text(data.header.pages);
                if (t.toLowerCase() === "features" || t.toLowerCase() === "recursos") $(this).text(data.header.features);
                if (t.toLowerCase() === "support" || t.toLowerCase() === "suporte") $(this).text(data.header.support);
            });
            $('.login span').text(data.header.login);
        }

        // 2. RECURSIVE CONTENT SWAP
        // This is the most important part. It finds the English text and swaps it with French.
        if (data.content) {
            $('h1, h2, h3, h4, h5, p, .btn, .title, .subheading, .description, a, li, span').each(function() {
                var el = $(this);
                // Check if element has child nodes (to avoid breaking icons)
                if (el.children().length > 0 && el.find('i, svg, img').length > 0) {
                    // Handle elements with icons separately
                    el.contents().filter(function(){ return this.nodeType === 3; }).each(function() {
                        var original = this.nodeValue.trim();
                        if (data.content[original]) {
                            this.nodeValue = this.nodeValue.replace(original, data.content[original]);
                        }
                    });
                } else {
                    var original = el.text().trim();
                    if (data.content[original]) {
                        el.text(data.content[original]);
                    }
                }
            });
        }
        
        console.log("Translations successfully applied for: " + lng);
    });
}

// Global cookie functions
function getCookie(name) {
    var nameEQ = name + "=";
    var ca = document.cookie.split(';');
    for(var i=0;i < ca.length;i++) {
        var c = ca[i];
        while (c.charAt(0)==' ') c = c.substring(1,c.length);
        if (c.indexOf(nameEQ) == 0) return c.substring(nameEQ.length,c.length);
    }
    return null;
}

function setCookie(name,value,days) {
    var expires = "";
    if (days) {
        var date = new Date();
        date.setTime(date.getTime() + (days*24*60*60*1000));
        expires = "; expires=" + date.toUTCString();
    }
    document.cookie = name + "=" + (value || "")  + expires + "; path=/";
}

// Event Listeners
$(document).ready(function() {
    var savedLng = getCookie("language") || "en-US";
    // Increase delay to ensure DOM is ready
    setTimeout(function() { applyTranslations(savedLng); }, 800);
});

$(document).on('click', '#drop-lng label', function() {
    var lng = $(this).attr('data-lng');
    setCookie("language", lng, 7);
    applyTranslations(lng);
});
