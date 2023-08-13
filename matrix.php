<!DOCTYPE html>
<html>

<head>
    <title>Matrix</title>
</head>

<body style="margin: 0">
    <canvas width="800" height="800" id="canvas"> </canvas>
    <script>
        <?php
        $characters = [
            "a", "b", "c", "d", "e", "f", "g", "h", "i", "j", "k", "l", "m", "n", "o", "p",
            "q", "r", "s", "t", "u", "v", "w", "x", "y", "z", "1", "2", "3", "4", "5", "6",
            "7", "8", "!", "@", "#", "$", "%", "^", "&", "*", "(", ")","♫", "♣", "♠", "♦", "♪", 
            "♯", "♩", "♬", "☼", "☽", "♀", "♂", "†", "‡", "◊", "∞", "‰",
            "§", "¶", "©", "®", "™", "№", "°", "±", "µ", "¶", "•", "·", "¬", "£", "¤", "¥", "¦",
            // Add more unique characters here
        ];
        $maxCharacterCount = 450;
        $fontSize = 13;
        $maxColumns = "canvasWidth / $fontSize";
        ?>

        const canvas = document.getElementById("canvas");
        const ctx = canvas.getContext("2d");

        let canvasWidth = window.innerWidth;
        let canvasHeight = window.innerHeight;

        canvas.width = canvasWidth;
        canvas.height = canvasHeight;

        let maxCanvasColumns = <?php echo $maxColumns; ?>;

        window.addEventListener('resize', function(event) {
            canvasWidth = window.innerWidth;
            canvasHeight = window.innerHeight;
            canvas.width = canvasWidth;
            canvas.height = canvasHeight;
            maxCanvasColumns = canvasWidth / <?php echo $fontSize; ?>;
        }, true);

        let fallingCharacters = [];

        class FallingCharacter {
            constructor(x, y) {
                this.x = x;
                this.y = y;
                this.fallSpeed = (Math.random() * <?php echo $fontSize; ?> * 3) / 6 + (<?php echo $fontSize; ?> * 3) / 6;
            }

            draw(context) {
                this.value = "<?php echo $characters[array_rand($characters)]; ?>";

                context.fillStyle = "rgba(0,255,0)";
                context.font = <?php echo $fontSize; ?> + "px sans-serif";

                context.fillText(this.value, this.x, this.y);
                this.y += this.fallSpeed;

                if (this.y > canvasHeight) {
                    this.y = (Math.random() * canvasHeight) / 2 - 50;
                    this.x = Math.floor(Math.random() * maxCanvasColumns) * <?php echo $fontSize; ?>;
                    this.fallSpeed = (-Math.random() * <?php echo $fontSize; ?> * 3) / 6 + (<?php echo $fontSize; ?> * 3) / 6;
                }

                // ... remaining draw code ...
            }
        }

        let frames = 0;

        let update = () => {
            if (fallingCharacters.length < <?php echo $maxCharacterCount; ?>) {
                let fallingChar = new FallingCharacter(
                    Math.floor(Math.random() * maxCanvasColumns) * <?php echo $fontSize; ?>,
                    (Math.random() * canvasHeight) / 2 - 50
                );
                fallingCharacters.push(fallingChar);
            }

            // Clear the canvas and redraw
            ctx.fillStyle = "rgba(0,0,0,0.11)";
            ctx.fillRect(0, 0, canvasWidth, canvasHeight);

            for (let i = 0; i < fallingCharacters.length; i++) {
                fallingCharacters[i].draw(ctx);
            }

            frames++;
            requestAnimationFrame(update);
        };

        requestAnimationFrame(update);
    </script>
</body>

</html>
