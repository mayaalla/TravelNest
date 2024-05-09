fetch('https://api.currencyfreaks.com/v2.0/rates/latest?apikey=46131187d620424dae5041612682dcea')
.then((result) => {
    let mydata = result.json();
    return mydata;
})
.then((currency) => {
    let name = document.querySelectorAll('.name');
    let value = document.querySelectorAll('.value');
    let i =0;
    for(i=0; i<name.length; i++){
        c = currency.rates[name[i].innerHTML];
        value[i].innerHTML = parseFloat(c).toFixed(2);
    }


})