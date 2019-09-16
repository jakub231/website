class StarRating {
    constructor(target, stars = 5) {
        this.target = target;
        this.stars = stars;

        let starsColored = document.createElement('div');
        starsColored.classList.add('stars-inner');
        this.target.append(starsColored);
        this.starsColored = starsColored;
    }

    setRating(rating, votes) {
        if (votes == 0) {
            return;
        }

        console.log(rating);

        const percentage = ((rating / votes) / this.stars) * 100;
        const percentageRounded = Math.round(percentage / 10) * 10 + '%';

        this.starsColored.style.width = percentageRounded;
    }

    setTooltip(text) {
        this.target.setAttribute('data-original-title', text);
    }
}

module.exports = StarRating;
