export function generateToc_(selectorQuery) {
    // get toc
    var toc = document.querySelector(selectorQuery)
    // insert anchor into headers
    var innerHtmlEdited = document.documentElement.innerHTML.replace(
        /<h([\d])>([^<]+)<\/h([\d])>/gi,
        function (match, openLevel, titleText, closeLevel) {
            if (openLevel != closeLevel) {
                return str;
            }
            console.log(match);
            console.log(openLevel);
            console.log(titleText);
            console.log(closeLevel);
            console.log("-------------------------")
            var anchor = titleText.replace(/ /g, "_");
            var anchoredHeader = "<h" + openLevel + "><a name=\"" + anchor + "\">"
                + titleText + "</a></h" + closeLevel + ">";
            console.log(anchoredHeader)
            return anchoredHeader;

            return match;
            return "<h" + openLevel + "><a name=\"" + anchor + "\">"
                + titleText + "</a></h" + closeLevel + ">";
        }
    )
    document.documentElement.innerHTML = innerHtmlEdited;

    function createTable(elem, data) {
        // create <ul> elem and add link li for h elem 
        var a = elem.selectorQuery("a")
        var linkName = a.getAttribute("name");
        var text = a.textContent;
        var link = `<li><a href=${"#" + linkName}>${text}</a>`;
        data += "ul" + link;

        // get next h elem 

        // compare level (level in h1 is 1 and so on and so forth)

        // if next level lower than level we close ul 
        // and return elem on witch we stoped
        // else call f with next level and data     
    }

    // start recursively generate toc 
    document.documentElement.innerHTML.replace(
        /<h([\d])>([^<]+)<\/h([\d])>/gi,
        function (match, openLevel, titleText, closeLevel) {
            if (openLevel != closeLevel) {
                return str;
            }
            // create <ul> elem and add link li for h elem 
            var a = elem.selectorQuery("a")
            var linkName = a.getAttribute("name");
            var text = a.textContent;
            var link = `<li><a href=${"#" + linkName}>${text}</a>`;
            data += "ul" + link;

            // get next h elem 

            // compare level (level in h1 is 1 and so on and so forth)

            // if next level lower than level we close ul 
            // and return elem on witch we stoped
            // else call f with next level and data  

        }
    )


    // get first h elem
    // call f where we get next h elem



    // get parent header and set level level 
    // create <ul> and add anchor to it
    // get next 
}


export function generateToc(selectorQuery) {
    var toc = "";
    var level = 0;

    document.querySelector(selectorQuery).innerHTML =
        document.querySelector(selectorQuery).innerHTML.replace(
            /<h([\d])>([^<]+)<\/h([\d])>/gi,
            function (str, openLevel, titleText, closeLevel) {
                if (openLevel != closeLevel) {
                    return str;
                }

                if (openLevel > level) {
                    toc += (new Array(openLevel - level + 1)).join("<ul>");
                } else if (openLevel < level) {
                    toc += (new Array(level - openLevel + 1)).join("</ul>");
                }

                level = parseInt(openLevel);

                var anchor = titleText.replace(/ /g, "_");
                toc += "<li><a href=\"#" + anchor + "\">" + titleText
                    + "</a></li>";

                return "<h" + openLevel + "><a name=\"" + anchor + "\">"
                    + titleText + "</a></h" + closeLevel + ">";
            }
        );

    if (level) {
        toc += (new Array(level + 1)).join("</ul>");
    }

    document.getElementById("toc").innerHTML += toc;
    console.log("created toc")
};

// function createLink(href, innerHTML) {
// 	var a = document.createElement("a");
// 	a.setAttribute("href", href);
// 	a.innerHTML = innerHTML;
// 	return a;
// }

// export function generateToc(selectorQuery) {
// 	var i2 = 0, i3 = 0, i4 = 0;
//     var toc = document.querySelector(selectorQuery);
// 	toc = toc.appendChild(document.createElement("ul"));
// 	for (var i = 0; i < document.body.childNodes.length; ++i) {
// 		var node = document.body.childNodes[i];
// 		var tagName = node.nodeName.toLowerCase();
// 		if (tagName == "h4") {
// 			++i4;
// 			if (i4 == 1) toc.lastChild.lastChild.lastChild.appendChild(document.createElement("ul"));
// 			var section = i2 + "." + i3 + "." + i4;
// 			node.insertBefore(document.createTextNode(section + ". "), node.firstChild);
// 			node.id = "section" + section;
// 			toc.lastChild.lastChild.lastChild.lastChild.appendChild(document.createElement("li")).appendChild(createLink("#section" + section, node.innerHTML));
// 		}
// 		else if (tagName == "h3") {
// 			++i3, i4 = 0;
// 			if (i3 == 1) toc.lastChild.appendChild(document.createElement("ul"));
// 			var section = i2 + "." + i3;
// 			node.insertBefore(document.createTextNode(section + ". "), node.firstChild);
// 			node.id = "section" + section;
// 			toc.lastChild.lastChild.appendChild(document.createElement("li")).appendChild(createLink("#section" + section, node.innerHTML));
// 		}
// 		else if (tagName == "h2") {
// 			++i2, i3 = 0, i4 = 0;
// 			var section = i2;
// 			node.insertBefore(document.createTextNode(section + ". "), node.firstChild);
// 			node.id = "section" + section;
// 			toc.appendChild(h2item = document.createElement("li")).appendChild(createLink("#section" + section, node.innerHTML));
// 		}
// 	}
// }
