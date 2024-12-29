import { Controller } from "@hotwired/stimulus";

export default class extends Controller {
    static targets = ["image", "popup", "popupImage", "prev", "next"];

    initialize() {
        this.currentIndex = 0;
    }

    connect() {
        this.hidePopup(); // Ukrywamy popup po załadowaniu kontrolera
    }

    openPopup(event) {
        // Pokazuje popup
        this.popupTarget.classList.remove("hidden");
        this.popupTarget.style.visibility = "visible"; // Ustawiamy widoczność popupu
        this.popupImageTarget.src = event.target.dataset.fullImage;
        this.currentIndex = this.getImageIndex(event.target.dataset.fullImage);
    }

    closePopup() {
        // Ukrywa popup
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
        return [...this.imageTargets]; // Zwraca tablicę wszystkich obrazków
    }

    getImageIndex(imageSrc) {
        return this.images.findIndex(image => image.dataset.fullImage === imageSrc); // Zwraca indeks obrazka
    }

    hidePopup() {
        // Ukrywa popup na początku
        this.popupTarget.style.visibility = "hidden";
    }
}
