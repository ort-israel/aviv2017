$(document).ready(function () {
    $('.about-title').on('click', function () {
            $('.course-metadata').toggleClass('hide');
            $('.course-summary').toggleClass('hide');
            $(this).toggleClass('hiddencontent');
        }
    );
    /* when enrolled in course, hide the details of about */
    $('.courserole-admin .about-title').addClass('hiddencontent');
    $('.courserole-admin .course-metadata, .courserole-admin .course-summary').addClass('hide');
    $('.courserole-teacher .about-title').addClass('hiddencontent');
    $('.courserole-teacher .course-metadata, .courserole-admin .course-summary').addClass('hide');
    $('.courserole-student .about-title').addClass('hiddencontent');
    $('.courserole-student .course-metadata, .courserole-admin .course-summary').addClass('hide');
});