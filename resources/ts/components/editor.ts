import SimpleMDE from "simplemde";

const defaultToolbar: (string | SimpleMDE.ToolbarIcon)[] = ["bold", "italic", "heading", "|", "quote", "unordered-list", "ordered-list", "|", "link", "image", "|", "preview", "side-by-side", "fullscreen", "|", "guide"]

const addCustomButtonToolbar = (index: number, callback: (editor: SimpleMDE) => void) => {
    // TODO: For some reason not working

    /* return defaultToolbar.splice(index, 0, {
        name: "upload",
        action: callback,
        className: "fa fa-upload",
        title: "Carica un immagine",
    }); */

    return defaultToolbar.push({
        name: "upload",
        action: callback,
        className: "fa fa-upload",
        title: "Carica un immagine",
    },);
};

export default function (editorElem: HTMLElement | undefined, uploadCallback: (editor: SimpleMDE) => void) {
    addCustomButtonToolbar(1, uploadCallback);

    return new SimpleMDE({
        element: editorElem,
        placeholder: "Scrivi il tuo articolo qui...",
        spellChecker: false,
        toolbar: defaultToolbar,
    });
}
