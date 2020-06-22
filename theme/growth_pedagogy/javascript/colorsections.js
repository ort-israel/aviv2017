/* This function colors the different sections each with its designated color, when the section is displayed on its own page.
* The way to determine what number section this is, is to correlate it with the navbar in the following way:
* The navbar has links to many parts of the course and the system, and among thos are links to all the sections.
* We differentiate those links by looking in their gref for the strings "course/view.php" and "sectionid=".
* Once we get a collection of those links, we look through them, looking  */
const urlParams = new URLSearchParams(window.location.search);
const sectionidParam = urlParams.get('sectionid');
if (sectionidParam != null) {
    let i = 1;
    let subSections = $("nav.list-group .list-group-item").each(function () {
        if (typeof ($(this).attr("href")) !== "undefined") {
            let currCourseviewPos = $(this).attr("href").indexOf("course/view.php", 0);
            let currSectionidKeyPos = $(this).attr("href").indexOf("sectionid=", 0);
            if (currCourseviewPos > -1 && currSectionidKeyPos > -1) {
                let sectionidVal = $(this).attr("href").substr(currSectionidKeyPos + "sectionid=".length);
                if (sectionidVal === sectionidParam) {
                    $("ul.flexsections.flexsections-level-0 > li >.content > h3.sectionname").addClass("section-nth-child-" + i);
                } else {
                    i++;
                }
            }
        }
    });
}
