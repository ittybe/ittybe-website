require('./bootstrap');
import { generateToc } from "./utils/generateToc";
window.onload = function () {

};
document.addEventListener('DOMContentLoaded', function () {
    // generate table of content
    generateToc(".markdown-body")

    // Get the list todo change name of variable 
    var toc = document.querySelector("#toc");
    var ul = document.querySelector("#toc ul");
    var footer = document.querySelector(".contacts");
    var placeholder = document.querySelector(".post-section .placeholder");
    // Get the offset position of the navbar
    var sticky = toc.offsetTop;

    function checkOffset() {
        function getRectTop(el){
          var rect = el.getBoundingClientRect();
          return rect.top;
        }
        
        if(((getRectTop(toc) + document.body.scrollTop) + toc.offsetHeight >= (getRectTop(footer) + document.body.scrollTop) - 10) &&
        toc.classList.contains("sticky")){
            toc.classList.add("absolute-style");
            toc.classList.remove("sticky");
            return true;
        }
          
        if((document.body.scrollTop + window.innerHeight < (getRectTop(footer) + document.body.scrollTop)) &&
        toc.classList.contains("absolute-style")){
            toc.classList.remove("absolute-style")
            toc.classList.add("sticky");
            return false;
        }
          
        // toc.innerHTML = document.body.scrollTop + window.innerHeight;
    }
    
    // Add the sticky class to the toc when you reach its scroll position. Remove "sticky" when you leave the scroll position
    function stickToc() {
        // var posStyles = ["mr-4", "pr-8"];

        if (document.documentElement.clientWidth >= 1024) {
            if (checkOffset()){
                return;
            }

            if (window.pageYOffset > sticky && !toc.classList.contains("absolute-style")) {
                setTimeout(function(){
                    toc.classList.add("sticky")
                        
                    placeholder.classList.add("block-style");
                    placeholder.classList.remove("none-style");
                }, 1)
                
                // ul.classList.add("sticky");
                // ul.classList.add("toc-width");

                // // placing of ul coping toc class
                // posStyles.forEach(styleClass => {
                //     ul.classList.add(styleClass)
                // });
                // toc.classList.add("none-style");


            } 
            else if (!toc.classList.contains("absolute-style")) {
                // ul.classList.remove("sticky");
                // ul.classList.remove("toc-width");
                // // placing of ul coping toc class
                // posStyles.forEach(styleClass => {
                //     ul.classList.remove(styleClass)
                // });

                toc.classList.remove("sticky")
                // toc.classList.remove("none-style");

                placeholder.classList.remove("block-style");
                placeholder.classList.add("none-style");
            }

        }
    }
    
    // When the user scrolls the page, execute myFunction
    window.onscroll = function () { stickToc() };
    // window.onscroll = function () { checkOffset() };

})

