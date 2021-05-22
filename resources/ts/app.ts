import fi from "feather-icons";

// Import all pages
import newArticlePage from "./pages/new-article";

//import components
import commentBox from "./components/commentbox";

$(() => {
    fi.replace();

    // Load all pages
    newArticlePage();

    // Load all components
    commentBox();
});
