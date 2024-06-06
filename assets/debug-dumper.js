function encapsuleDumper(selector) {
    const dumper = document.querySelectorAll(selector);
    let box = document.createElement("div");
        box.classList.add("dump-box");
        document.body.appendChild(box);
    if (dumper.length > 1) {
        dumper.forEach(dumperItem => {
            box.appendChild(dumperItem);
        });    
    }
}

encapsuleDumper('.dump');

function alerting() {
    let alert = document.createElement("div");
    alert.classList.add("dump-alert");
    document.body.appendChild(alert);
}