// Handle vote card selection
document.addEventListener('DOMContentLoaded', function() {
    const voteRadios = document.querySelectorAll('.vote-radio');
    const submitBtn = document.getElementById('submitBtn');
    
    voteRadios.forEach(radio => {
        radio.addEventListener('change', function() {
            // Remove selected class from all cards
            document.querySelectorAll('.vote-card').forEach(card => {
                card.classList.remove('selected');
            });
            // Add selected class to the card of the checked radio
            if (this.checked) {
                document.getElementById('card-' + this.value).classList.add('selected');
                submitBtn.disabled = false;
            }
        });
    });
});
