require('./bootstrap');
import { generateToc } from "./utils/generateToc";
import {fillInputField} from "./utils/fillInputField";
window.onload = function () {
    try {
        fillInputField()
    } catch (error) {
        console.error(error)
    }
    try {
        generateToc(".markdown-body")
    } catch (error) {
        console.error(error)
    }    
};
