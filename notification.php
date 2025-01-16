<?php
$cities = [
    'Samsun', 'İstanbul', 'Ankara', 'İzmir', 'Bursa', 'Tekirdağ', 'Adana', 'Gaziantep', 'Manisa', 'Balıkesir', 'Bursa', 
    'Antalya', 'Trabzon', 'Eskişehir', 'Konya', 'Adana'
];

$products = [
    ['name' => '50 Adet Taklacı Bilezikleri', 'image' => 'https://www.guvercinmalzemeleri.com/images/product/54463-570-1.png'],
    ['name' => '50 Adet Posta Bilezikleri', 'image' => 'https://www.guvercinmalzemeleri.com/images/product/54463-570-1.png'],
    ['name' => '50 Adet Kelebek Bilezikleri', 'image' => 'https://www.guvercinmalzemeleri.com/images/product/54463-570-1.png'],
    ['name' => '50 Adet Krom Kesilmez', 'image' => 'https://www.guvercinmalzemeleri.com/images/product/big_photo/product_krom-guvercin-bilezikleri500x50022940432509851.jpg'],
    ['name' => '50 Adet Dönek Bilezikleri', 'image' => 'https://www.guvercinmalzemeleri.com/images/product/54463-570-1.png']
];

$times = ['1 dakika önce', '5 dakika önce', '15 dakika önce', '1 saat önce', '3 saat önce'];

function getRandomNotification() {
    global $cities, $products, $times;
    
    return [
        'city' => $cities[array_rand($cities)],
        'product' => $products[array_rand($products)],
        'time' => $times[array_rand($times)]
    ];
}

$notification = getRandomNotification();
?>

<style>
@keyframes slideIn {
    0% {
        opacity: 0;
        transform: translateX(100px);
    }
    100% {
        opacity: 1;
        transform: translateX(0);
    }
}

@keyframes slideOut {
    0% {
        opacity: 1;
        transform: translateX(0);
    }
    100% {
        opacity: 0;
        transform: translateX(100px);
        display: none;
    }
}

.notification-container {
    position: fixed;
    bottom: 20px;
    right: 20px;
    z-index: 50;
    width: 320px;
    visibility: hidden;
}

.notification-container.show {
    visibility: visible;
}

@media (max-width: 768px) {
    .notification-container {
        display: none;
    }
}

.notification-box {
    background-color: white;
    border-radius: 0.5rem;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    padding: 0.75rem;
    width: 100%;
    border: 1px solid #f3f4f6;
    animation: slideIn 0.5s ease-out forwards;
    transition: box-shadow 0.2s ease-in-out;
}

.notification-box.hiding {
    animation: slideOut 0.5s ease-in forwards;
}

.notification-box:hover {
    box-shadow: 0 6px 8px rgba(0, 0, 0, 0.15);
}

.notification-content {
    display: flex;
    align-items: center;
    gap: 0.75rem;
}

.product-image {
    width: 3rem;
    height: 3rem;
    flex-shrink: 0;
}

.product-image img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    border-radius: 0.375rem;
}

.notification-text {
    flex: 1;
    min-width: 0;
}

.city-text {
    font-size: 0.75rem;
    color: #4b5563;
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
    margin: 0;
}

.product-name {
    font-size: 0.875rem;
    font-weight: 500;
    color: #1f2937;
    margin: 0 0 0.125rem 0;
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
}

.notification-meta {
    display: flex;
    align-items: center;
    gap: 0.5rem;
}

.time {
    font-size: 0.75rem;
    color: #6b7280;
}

.status {
    display: flex;
    align-items: center;
    gap: 0.125rem;
    color: #059669;
}

.status-text {
    font-size: 0.75rem;
    font-weight: 500;
}
</style>

<div class="notification-container">
    <div class="notification-box">
        <div class="notification-content">
            <div class="product-image">
                <img src="<?php echo htmlspecialchars($notification['product']['image']); ?>" 
                     alt="<?php echo htmlspecialchars($notification['product']['name']); ?>">
            </div>
            <div class="notification-text">
                <p class="city-text">
                    <strong><?php echo htmlspecialchars($notification['city']); ?></strong> şehrinden
                </p>
                <p class="product-name">
                    <?php echo htmlspecialchars($notification['product']['name']); ?> satın alındı
                </p>
                <div class="notification-meta">
                    <span class="time"><?php echo htmlspecialchars($notification['time']); ?></span>
                    <div class="status">
                        <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 24 24" fill="none" 
                             stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path>
                            <polyline points="22 4 12 14.01 9 11.01"></polyline>
                        </svg>
                        <span class="status-text">Onaylandı</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
function showNotification(data) {
    const container = document.querySelector('.notification-container');
    const oldBox = container.querySelector('.notification-box');
    
    // Yeni bildirimi göster
    container.classList.add('show');
    
    if (oldBox) {
        oldBox.classList.add('hiding');
        setTimeout(() => {
            const newBox = document.createElement('div');
            newBox.className = 'notification-box';
            newBox.innerHTML = `
                <div class="notification-content">
                    <div class="product-image">
                        <img src="${data.product.image}" alt="${data.product.name}">
                    </div>
                    <div class="notification-text">
                        <p class="city-text">
                            <strong>${data.city}</strong> şehrinden
                        </p>
                        <p class="product-name">
                            ${data.product.name} satın alındı
                        </p>
                        <div class="notification-meta">
                            <span class="time">${data.time}</span>
                            <div class="status">
                                <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 24 24" fill="none" 
                                     stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path>
                                    <polyline points="22 4 12 14.01 9 11.01"></polyline>
                                </svg>
                                <span class="status-text">Onaylandı</span>
                            </div>
                        </div>
                    </div>
                </div>
            `;
            oldBox.remove();
            container.appendChild(newBox);
            
            // 5 saniye sonra bildirimi gizle
            setTimeout(() => {
                newBox.classList.add('hiding');
                setTimeout(() => {
                    container.classList.remove('show');
                }, 500);
            }, 5000);
        }, 500);
    }
}

function updateNotification() {
    fetch('get_notification.php')
        .then(response => response.json())
        .then(data => {
            showNotification(data);
        });
}

// İlk bildirimi göster
updateNotification();

// Her 10 saniyede bir yeni bildirim göster
setInterval(updateNotification, 10000);
</script>
