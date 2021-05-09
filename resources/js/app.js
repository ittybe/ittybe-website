require('./bootstrap');
import { generateToc } from "./utils/generateToc";
window.onload = function () {
    generateToc(".markdown-body")

};
