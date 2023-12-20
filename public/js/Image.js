document.addEventListener("DOMContentLoaded", function () {
    class Lightbox {
        constructor(images) {
            this.images = images;
            this.currentIndex = 0;
            this.init();
        }

        init() {
            this.images.forEach(image => {
                image.addEventListener('click', () => this.openLightbox(image));
            });

            document.addEventListener("keyup", event => {
                if (event.key === "Escape") {
                    this.closeLightbox();
                } else if (event.key === "ArrowLeft" || event.key === "ArrowRight") {
                    this.navigateImages(event.key);
                }
            });
        }

        openLightbox(image) {
            this.currentIndex = Array.from(this.images).indexOf(image);

            const lightboxContainer = document.createElement("div");
            lightboxContainer.id = "lightboxContainer";
            lightboxContainer.style.position = "fixed";
            lightboxContainer.style.top = "0";
            lightboxContainer.style.left = "0";
            lightboxContainer.style.width = "100%";
            lightboxContainer.style.height = "100%";
            lightboxContainer.style.background = "rgba(0, 0, 0, 0.8)";
            lightboxContainer.style.display = "flex";
            lightboxContainer.style.justifyContent = "center";
            lightboxContainer.style.alignItems = "center";

            const img = document.createElement("img");
            img.id = "lightboxImg";
            img.className = "lightbox-img";
            img.src = image.src;

            const close = this.createButton("X", "red", () => this.closeLightbox());
            close.id = "closeButton";
            close.style.position = "absolute";
            close.style.top = "10px";
            close.style.right = "10px";

            const prevButton = this.createButton("<", null, () => this.navigateImages("ArrowLeft"));
            prevButton.id = "prevButton";
            prevButton.style.position = "absolute";
            prevButton.style.left = "10px";
            prevButton.style.top = "50%";
            prevButton.style.transform = "translateY(-50%)";

            const nextButton = this.createButton(">", null, () => this.navigateImages("ArrowRight"));
            nextButton.id = "nextButton";
            nextButton.style.position = "absolute";
            nextButton.style.right = "10px";
            nextButton.style.top = "50%";
            nextButton.style.transform = "translateY(-50%)";

            lightboxContainer.appendChild(prevButton);
            lightboxContainer.appendChild(img);
            lightboxContainer.appendChild(nextButton);
            lightboxContainer.appendChild(close);
            document.body.appendChild(lightboxContainer);

            document.body.style.overflow = "hidden";
        }

        closeLightbox() {
            const lightboxContainer = document.getElementById('lightboxContainer');
            if (lightboxContainer) {
                lightboxContainer.remove();
                document.body.style.overflow = "";
            }
        }

        navigateImages(direction) {
            if (direction === "ArrowLeft") {
                this.currentIndex = (this.currentIndex - 1 + this.images.length) % this.images.length;
            } else if (direction === "ArrowRight") {
                this.currentIndex = (this.currentIndex + 1) % this.images.length;
            }

            const img = document.getElementById('lightboxImg');
            img.src = this.images[this.currentIndex].src;
        }

        createButton(text, color, clickHandler) {
            const button = document.createElement("div");
            button.innerText = text;
            button.style.backgroundColor = color || "#ffffff";
            button.style.color = color ? "#ffffff" : "#000000";
            button.style.padding = "10px";
            button.style.fontSize = "24px";
            button.style.cursor = "pointer";
            button.addEventListener('click', clickHandler);
            return button;
        }
    }

    const lightbox = new Lightbox(document.querySelectorAll(".lightbox"));
});
