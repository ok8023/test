function get_middle_text(str, left, right) {
    str = str.substring(str.indexOf(left) + left.length, str.indexOf(right))
    return str
}

function copy_text(text) {
    var dummy = document.createElement('textarea');
    
    document.body.appendChild(dummy);
    dummy.value = text;
    dummy.select();
    document.execCommand('copy');
    document.body.removeChild(dummy);
}