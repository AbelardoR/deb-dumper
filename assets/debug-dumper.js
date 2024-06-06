function encapsuleDumper(selector) {
    const dumper = document.querySelectorAll(selector);
    let box = document.createElement("div");
        box.classList.add("dump-box");
    if (dumper.length > 0) {
        document.body.appendChild(box);
        dumper.forEach(dumperItem => {
            box.appendChild(dumperItem);
        });    
    }
}

encapsuleDumper('.dump');

function alerting(selector="body") {
    const dumbox = document.querySelector('.dump-box');
    if (dumbox == null) {return false; }

    let container = document.querySelector(selector);
    let alert = document.createElement("div");
    alert.classList.add("dump-alert");
    alert.textContent = 'Debug dump is active';
    container.appendChild(alert);

    // show custom alert after 1/2 seconds
    setTimeout(() => {
        alert.classList.add("show");
    }, 500);
    // Hide custom alert after 3 seconds
    setTimeout(() => {
        alert.classList.remove("show");
    }, 3000);
}

alerting();