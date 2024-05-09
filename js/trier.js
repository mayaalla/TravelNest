let sortby;
document.addEventListener('DOMContentLoaded', function() {
    document.getElementById('sortByNote').addEventListener('click', function(e) {
        e.preventDefault();
        sortby = 'note'
        fetchSortedHotels();
    });
    document.getElementById('sortByStarslh').addEventListener('click', function(e){
        e.preventDefault();
        sortby = 'starshl'
        fetchSortedHotelsStarslh();
    })
    document.getElementById('sortByStarshl').addEventListener('click', function(e){
        e.preventDefault();
        
        fetchSortedHotelsStarshl();
    })
    document.getElementById('sortByPricelh').addEventListener('click', function(e){
        e.preventDefault();
        
        fetchSortedHotelsPricelh();
    })
    document.getElementById('sortByPricehl').addEventListener('click', function(e){
        e.preventDefault();
        
        fetchSortedHotelsPricehl();
    })

});

function fetchSortedHotels() {
    // Example: Extract values from form inputs or define them here
    let destination = document.getElementById('destination').value;
    let checkin = document.getElementById('checkin').value;
    let checkout = document.getElementById('checkout').value;
    let adults = document.getElementById('adults').value;
    let children = document.getElementById('children').value;
    let rooms = document.getElementById('rooms').value;
    let url = `fetchSortedHotels.php?destination=${encodeURIComponent(destination)}&checkin=${encodeURIComponent(checkin)}&checkout=${encodeURIComponent(checkout)}&adults=${encodeURIComponent(adults)}&children=${encodeURIComponent(children)}&rooms=${encodeURIComponent(rooms)}`
    fetch(url)
    .then(response => response.text())
    .then(data => {
        document.querySelector('#bigcard').innerHTML = data;
    })
    .catch(error => console.error('Error:', error));
}
function fetchSortedHotelsStarslh() {
    // Example: Extract values from form inputs or define them here
    let destination = document.getElementById('destination').value;
    let checkin = document.getElementById('checkin').value;
    let checkout = document.getElementById('checkout').value;
    let adults = document.getElementById('adults').value;
    let children = document.getElementById('children').value;
    let rooms = document.getElementById('rooms').value;
    let url = `fetchstarslh.php?destination=${encodeURIComponent(destination)}&checkin=${encodeURIComponent(checkin)}&checkout=${encodeURIComponent(checkout)}&adults=${encodeURIComponent(adults)}&children=${encodeURIComponent(children)}&rooms=${encodeURIComponent(rooms)}`
    fetch(url)
    .then(response => response.text())
    .then(data => {
        document.querySelector('#bigcard').innerHTML = data;
    })
    .catch(error => console.error('Error:', error));
}
function fetchSortedHotelsStarshl() {
    // Example: Extract values from form inputs or define them here
    let destination = document.getElementById('destination').value;
    let checkin = document.getElementById('checkin').value;
    let checkout = document.getElementById('checkout').value;
    let adults = document.getElementById('adults').value;
    let children = document.getElementById('children').value;
    let rooms = document.getElementById('rooms').value;
    let url = `fetchstarshl.php?destination=${encodeURIComponent(destination)}&checkin=${encodeURIComponent(checkin)}&checkout=${encodeURIComponent(checkout)}&adults=${encodeURIComponent(adults)}&children=${encodeURIComponent(children)}&rooms=${encodeURIComponent(rooms)}`
    fetch(url)
    .then(response => response.text())
    .then(data => {
        document.querySelector('#bigcard').innerHTML = data;
    })
    .catch(error => console.error('Error:', error));
}
function fetchSortedHotelsPricelh() {
    // Example: Extract values from form inputs or define them here
    let destination = document.getElementById('destination').value;
    let checkin = document.getElementById('checkin').value;
    let checkout = document.getElementById('checkout').value;
    let adults = document.getElementById('adults').value;
    let children = document.getElementById('children').value;
    let rooms = document.getElementById('rooms').value;
    let url = `fetchpricelh.php?destination=${encodeURIComponent(destination)}&checkin=${encodeURIComponent(checkin)}&checkout=${encodeURIComponent(checkout)}&adults=${encodeURIComponent(adults)}&children=${encodeURIComponent(children)}&rooms=${encodeURIComponent(rooms)}`
    fetch(url)
    .then(response => response.text())
    .then(data => {
        document.querySelector('#bigcard').innerHTML = data;
    })
    .catch(error => console.error('Error:', error));
}
function fetchSortedHotelsPricehl() {
    // Example: Extract values from form inputs or define them here
    let destination = document.getElementById('destination').value;
    let checkin = document.getElementById('checkin').value;
    let checkout = document.getElementById('checkout').value;
    let adults = document.getElementById('adults').value;
    let children = document.getElementById('children').value;
    let rooms = document.getElementById('rooms').value;
    let url = `fetchpricehl.php?destination=${encodeURIComponent(destination)}&checkin=${encodeURIComponent(checkin)}&checkout=${encodeURIComponent(checkout)}&adults=${encodeURIComponent(adults)}&children=${encodeURIComponent(children)}&rooms=${encodeURIComponent(rooms)}`
    fetch(url)
    .then(response => response.text())
    .then(data => {
        document.querySelector('#bigcard').innerHTML = data;
    })
    .catch(error => console.error('Error:', error));
}