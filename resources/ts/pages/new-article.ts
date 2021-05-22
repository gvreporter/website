import SimpleMDE from "simplemde";
import buildEditor from "../components/editor";
import Editor from '@toast-ui/editor';
import axios from "axios";

const showFileChooser = (editor: SimpleMDE) => {
    const fileChooser = document.createElement('input');
    fileChooser.addEventListener('change', (event) => uploadFile(editor, fileChooser), false);
    fileChooser.type = 'file';
    fileChooser.click();
};

const uploadFile = async (editor: SimpleMDE, input: HTMLInputElement) => {
    if(!input.files) return;

    let body = new FormData();
    body.append('file', input.files[0]);

    console.log(body.getAll('file'));
    try {
        const res = await axios.post('/admin/upload', body);
    } catch (error) {
        console.error(error);
        toastr.error("Non è stato possibile caricare il file sul server. Riprova più tardi.", "Si è verificato un errore");
    } finally {
        input.remove();
    }
};

export default function () {
    const editorElem = document.getElementById('editor');
    if(!editorElem) return;

    const editor = buildEditor(editorElem, showFileChooser);
}
