const modal = document.getElementById('gameModal');
const closeModal = document.querySelector('.close');


const buyButtons = document.querySelectorAll('.buy-button');


buyButtons.forEach(button => {
    button.addEventListener('click', function() {
        
        const game = this.closest('.product');
        const gameName = game.getAttribute('data-name');
        const gamePrice = game.getAttribute('data-price');
        const gameDetails = game.getAttribute('data-details');
        const gameRating = parseFloat(game.getAttribute('data-rating'));

        
        document.getElementById('gameTitle').textContent = gameName;
        document.getElementById('gamePrice').textContent = `Price: ${gamePrice}`;
        document.getElementById('gameDetails').textContent = gameDetails;

        
        let ratingStars = '';
        for (let i = 0; i < 5; i++) {
            if (i < gameRating) {
                ratingStars += '⭐';
            } else {
                ratingStars += '☆';
            }
        }
        document.getElementById('gameRating').innerHTML = `Rating: ${ratingStars}`;

        
        modal.style.display = 'block';
    });
});

closeModal.addEventListener('click', function() {
    modal.style.display = 'none';
});

window.addEventListener('click', function(event) {
    if (event.target == modal) {
        modal.style.display = 'none';
    }
});
