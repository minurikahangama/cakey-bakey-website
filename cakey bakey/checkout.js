document.addEventListener('DOMContentLoaded', function() {
    const deliveryBtn = document.getElementById('delivery-btn');
    const pickupBtn = document.getElementById('pickup-btn');
    const deliveryAddress = document.getElementById('delivery-address');
    const pickupAddress = document.getElementById('pickup-address');

    deliveryBtn.addEventListener('click', function() {
        deliveryAddress.style.display = 'block';
        pickupAddress.style.display = 'none';
        deliveryBtn.classList.add('active');
        pickupBtn.classList.remove('active');
    });

    pickupBtn.addEventListener('click', function() {
        pickupAddress.style.display = 'block';
        deliveryAddress.style.display = 'none';
        pickupBtn.classList.add('active');
        deliveryBtn.classList.remove('active');
    });
});
document.addEventListener('DOMContentLoaded', function() {
    const deliveryBtn = document.getElementById('delivery-btn');
    const pickupBtn = document.getElementById('pickup-btn');
    const deliveryAddress = document.getElementById('delivery-address');
    const pickupAddress = document.getElementById('pickup-address');

    deliveryBtn.addEventListener('click', function() {
        deliveryAddress.style.display = 'block';
        pickupAddress.style.display = 'none';
    });

    pickupBtn.addEventListener('click', function() {
        pickupAddress.style.display = 'block';
        deliveryAddress.style.display = 'none';
    });
})
