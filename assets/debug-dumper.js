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

function alerting(selector='.dump-box') {
    const dumbox = document.querySelector(selector);
    if (dumbox == null) {return false; }

    let alert = document.createElement("div");
    alert.classList.add("dump-alert");
    alert.textContent = 'Debug dump is active';
    dumbox.appendChild(alert);

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


function showHidePanel(selector='.dump-box') {
    const dumbox = document.querySelector(selector);
    if (dumbox == null) {return false; }

    const body = document.querySelector('body');
    let button = document.createElement("button");
    button.classList.add("dump-button");
    button.textContent = 'Hide debug panel';
    body.appendChild(button);

    button.addEventListener('click',function (event) {
        event.preventDefault();
        dumbox.classList.toggle('hide');
        if (dumbox.classList.contains('hide')) {
            button.textContent = 'Show debug panel';
        } else {
            button.textContent = 'Hide debug panel';
        }
    });
}

showHidePanel();