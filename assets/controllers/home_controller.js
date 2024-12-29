// home_controller.js
import { Controller } from "@hotwired/stimulus";

export default class extends Controller {
    static targets = ["image", "name"];

    connect() {
        console.log("HomeComponent connected!");
    }
}
