async function get(url) {
    return await fetch(url);
}

let tags;
(async () => {
    tags = await (await get("https://api.github.com/repos/itsHardStyl3r/egzaminy_zawodowe_EE.09/git/trees/master?recursive=1")).json()
    for (const element of tags.tree) {
        const load = document.getElementById("load");
        if (element.path.includes("/")) {
            let text = "", name = "", type = "", pdf = "";
            if (element.path.endsWith(".pdf")) {
                pdf = element.path;
            }
            if (element.type === 'tree') {
                name = element.path.split("/")[1];
                type = element.path.split("/")[0];
                text += "<tr><td>" + type.toUpperCase() + "</td>" +
                    "<td>" + name + "</td>" +
                    "<td><a href='https://github.com/itsHardStyl3r/egzaminy_zawodowe_EE.09/tree/master/" + element.path + "'>" +
                    "<img style='max-width:16px; vertical-align: -1px' src=\"https://cdn.jsdelivr.net/npm/simple-icons@v6/icons/github.svg\" alt='github icon'/> link</a></td></tr>"
                load.innerHTML += text;
            }
        }
    }
})()

let markdown;
(async () => {
    markdown = await (await get("https://raw.githubusercontent.com/itsHardStyl3r/egzaminy_zawodowe_EE.09/master/README.md")).text();
    document.getElementById("markdown").innerHTML = markdown;
})()