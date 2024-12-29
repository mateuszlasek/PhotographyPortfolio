import { startStimulusApp } from '@symfony/stimulus-bundle';
import gallery_controller from "./controllers/gallery_controller.js";

const app = startStimulusApp();
// register any custom, 3rd party controllers here
app.register('gallery', gallery_controller);
