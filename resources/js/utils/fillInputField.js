// after entering data in input data in input field erases so this file to solve this problem 
export function fillInputField(){
    const queryString = window.location.search;
    const urlParams = new URLSearchParams(queryString);
    const query= urlParams.get('q')
    var inputField = document.querySelector(".input-group input")
    inputField.value = query
}