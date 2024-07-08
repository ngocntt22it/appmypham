var container = document.getElementById('circleContainer');
var wrapperWidth = document.querySelector('.circle-wrapper').clientWidth;
var scrollStep = wrapperWidth * 2;

function scrollContainer(direction) {
    var currentScrollLeft = container.scrollLeft;

    if (direction === 'next') {
        container.scrollTo({
            left: currentScrollLeft + scrollStep,
            behavior: 'smooth'
        });
    } else if (direction === 'prev') {
        container.scrollTo({
            left: currentScrollLeft - scrollStep,
            behavior: 'smooth'
        });
    }
}