<!DOCTYPE html>
<html>

<head>
    <title>Matrix</title>
</head>

<body style="margin: 0">
    <canvas width="800" height="800" id="canvas"> </canvas>
    <script>
        <?php
        $charArr = [
            "a", "b", "c", "d", "e", "f", "g", "h", "i", "j", "k", "l", "m", "n", "o", "p",
            "q", "r", "s", "t", "u", "v", "w", "x", "y", "z", "1", "2", "3", "4", "5", "6",
            "7", "8", "!", "@", "#", "$", "%", "^", "&", "*", "(", ")", // Existing characters
            "♫", "♣", "♠", "♦", "♪", "♯", "♩", "♬", "☼", "☽", "♀", "♂", "†", "‡", "◊", "∞", "‰",
            "§", "¶", "©", "®", "™", "№", "°", "±", "µ", "¶", "•", "·", "¬", "£", "¤", "¥", "¦",
            // Add more unique characters here
        ];
        $maxCharCount = 500;
        $fontSize = 13;
        $maxColumns = "cw / $fontSize";
        ?>

        const canvas = document.getElementById("canvas");
        const ctx = canvas.getContext("2d");

        let cw = window.innerWidth;
        let ch = window.innerHeight;

        canvas.width = cw;
        canvas.height = ch;

        let maxColumns = <?php echo $maxColumns; ?>;

        window.addEventListener('resize', function(event) {
            cw = window.innerWidth;
            ch = window.innerHeight;
            canvas.width = cw;
            canvas.height = ch;
            maxColumns = cw / <?php echo $fontSize; ?>;
        }, true);

        let fallingCharArr = [];

        class FallingChar {
            constructor(x, y) {
                this.x = x;
                this.y = y;
            }

            draw(ctx) {
                this.value = "<?php echo $charArr[array_rand($charArr)]; ?>";
                this.speed = (Math.random() * <?php echo $fontSize; ?> * 3) / 6 + (<?php echo $fontSize; ?> * 3) / 6;

                ctx.fillStyle = "rgba(0,255,0)";
                ctx.font = <?php echo $fontSize; ?> + "px sans-serif";

                // Adjust the delay to control the animation speed
                const delay = 100; // Add a delay of 100 milliseconds between frames
                setTimeout(() => {
                    ctx.fillText(this.value, this.x, this.y);
                    this.y += this.speed;

                    if (this.y > ch) {
                        this.y = (Math.random() * ch) / 2 - 50;
                        this.x = Math.floor(Math.random() * maxColumns) * <?php echo $fontSize; ?>;
                        this.speed = (-Math.random() * <?php echo $fontSize; ?> * 3) / 6 + (<?php echo $fontSize; ?> * 3) / 6;
                    }
                }, delay);

                // ... remaining draw code ...
            }
        }

        let frames = 0;

        let update = () => {
            if (fallingCharArr.length < <?php echo $maxCharCount; ?>) {
                let fallingChar = new FallingChar(
                    Math.floor(Math.random() * maxColumns) * <?php echo $fontSize; ?>,
                    (Math.random() * ch) / 2 - 50
                );
                fallingCharArr.push(fallingChar);
            }

            // Clear the canvas and redraw
            ctx.fillStyle = "rgba(0,0,0,0.11)";
            ctx.fillRect(0, 0, cw, ch);

            for (let i = 0; i < fallingCharArr.length; i++) {
                fallingCharArr[i].draw(ctx);
            }

            requestAnimationFrame(update);
            frames++;
        };

        update();
    </script>
</body>

</html>
