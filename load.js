async function get(url) {
    return await fetch(url);
}

let tags, extended;
(async () => {
    tags = await (await get("https://api.github.com/repos/itsHardStyl3r/egzaminy_zawodowe_EE.09/git/trees/master?recursive=1")).json()
    extended = await (await get("https://raw.githubusercontent.com/itsHardStyl3r/egzaminy_zawodowe_EE.09/master/data.json")).json()
    let now = new Date();
    for (const element of tags.tree) {
        const load = document.getElementById("load");
        if (element.path.includes("/")) {
            let text = "", name = "", type = "", pdf = "", stack = "", date = "", title = "", live = "", download = "";
            if (element.path.endsWith(".pdf")) {
                pdf = element.path;
            }
            if (element.type === 'tree') {
                name = element.path.split("/")[1];
                type = element.path.split("/")[0];
                stack = extended.exams[type][name].stack;
                date = extended.exams[type][name].date;
                pdf = extended.exams[type][name].pdf;
                title = extended.exams[type][name].title;
                live = extended.exams[type][name].live;
                download = "https://kinolien.github.io/gitzip/?download=itsHardStyl3r/egzaminy_zawodowe_EE.09/tree/master/" + type + "/" + name;
                if (now.getFullYear() === +date.split("-")[2]) date += (" <span style='cursor: help' title='Egzamin z tego roku'>📣</span>");
                text += "<tr>" +
                    "<td>" + name + " | " + title + (live != null ? " (<a href='http://hardstyl3r.ct8.pl/exams/" + name + "/" + live + "' target='_blank'>podgląd</a>)" : "") + "</td>" +
                    "<td>" + date + "</td>" +
                    "<td>" + stack + "</td>" +
                    "<td><a href='https://github.com/itsHardStyl3r/egzaminy_zawodowe_EE.09/tree/master/" + element.path + "/" + pdf + "'>zobacz</a>" +
                    " / <a href='https://github.com/itsHardStyl3r/egzaminy_zawodowe_EE.09/raw/master/" + element.path + "/" + pdf + "'>pobierz (.pdf)</a></td>" +
                    "<td><a href='https://github.com/itsHardStyl3r/egzaminy_zawodowe_EE.09/tree/master/" + element.path + "'>" +
                    "<img style='max-width:16px; vertical-align: -2px' src=\"https://cdn.jsdelivr.net/npm/simple-icons@v6/icons/github.svg\" alt='github icon'/> link</a> / <a href='" + download + "' target='_blank'>pobierz</a></td></tr>"
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
