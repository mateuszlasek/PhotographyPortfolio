import { Controller } from "@hotwired/stimulus";

export default class extends Controller {
    static targets = ["image", "popup", "popupImage", "prev", "next"];

    initialize() {
        this.currentIndex = 0;
    }

    connect() {
        this.hidePopup();
    }

    openPopup(event) {
        this.popupTarget.classList.remove("hidden");
        this.popupTarget.style.visibility = "visible";
        this.popupImageTarget.src = event.target.dataset.fullImage;
        this.currentIndex = this.getImageIndex(event.target.dataset.fullImage);
    }

    closePopup() {
        this.popupTarget.style.visibility = "hidden";
    }

    nextImage() {
        this.currentIndex = (this.currentIndex === this.images.length - 1) ? 0 : this.currentIndex + 1;
        this.popupImageTarget.src = this.images[this.currentIndex].dataset.fullImage;
    }

    prevImage() {
        this.currentIndex = (this.currentIndex === 0) ? this.images.length - 1 : this.currentIndex - 1;
        this.popupImageTarget.src = this.images[this.currentIndex].dataset.fullImage;
    }

    get images() {
        return [...this.imageTargets];
    }

    getImageIndex(imageSrc) {
        return this.images.findIndex(image => image.dataset.fullImage === imageSrc);
    }

    hidePopup() {
        this.popupTarget.style.visibility = "hidden";
    }
}
