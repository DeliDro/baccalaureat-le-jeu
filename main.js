setInterval(() => {
    console.log("ALLEZ");
    fetch("/api/update_state", {method:"post"})
        // .then(res => console.log(res))
        // .catch(e => console.error(e));
}, 3000);