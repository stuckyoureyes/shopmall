<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Slider Example</title>
    <link rel="stylesheet" href="style.css">
    <style>
        /* 슬라이더 스타일 */
        .slider-section {
            margin: 20px 0;
        }

        .image-slider {
            overflow: hidden;
            white-space: nowrap;
            position: relative;
        }

        .image-track {
            display: flex;
            transition: transform 0.5s ease-in-out;
        }

        .image-card {
            flex: 0 0 auto;
            width: 300px;
            margin-right: 10px;
            text-align: center;
        }

        .image-card img {
            width: 100%;
            height: auto;
            border-radius: 10px;
        }
    </style>
</head>

<body>
    <div class="slider-section">
        <h2 style="text-align: center; color: red;">Top Seller</h2>
        <div class="image-slider">
            <div class="image-track">
                <div class="image-card">
                    <img src="/shopmall/image/image1.png" alt="Best Item 1">
                </div>
                <div class="image-card">
                    <img src="/shopmall/image/image2.png" alt="Best Item 2">
                </div>
                <div class="image-card">
                    <img src="/shopmall/image/image3.png" alt="Best Item 3">
                </div>
                <div class="image-card">
                    <img src="/shopmall/image/image4.png" alt="Best Item 4">
                </div>
                <div class="image-card">
                    <img src="/shopmall/image/image5.png" alt="Best Item 5">
                </div>
                <div class="image-card">
                    <img src="/shopmall/image/image6.png" alt="Best Item 6">
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const sliders = document.querySelectorAll('.image-slider');
            sliders.forEach(slider => {
                const track = slider.querySelector('.image-track');
                const cards = track.querySelectorAll('.image-card');
                const cardWidth = cards[0].offsetWidth;
                let index = 0;

                const autoSlide = () => {
                    index++;
                    if (index >= cards.length) {
                        index = 0;
                    }
                    track.style.transform = `translateX(-${index * cardWidth}px)`;
                };

                let interval = setInterval(autoSlide, 3000);

                slider.addEventListener('mouseover', () => clearInterval(interval));
                slider.addEventListener('mouseleave', () => {
                    interval = setInterval(autoSlide, 3000);
                });
            });
        });
    </script>
</body>

</html>
