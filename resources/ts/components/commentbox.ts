export default function () {
    const $form = $('.commentbox_form');
    const $input = $('.commentbox_form .commentbox_input');
    const $sendBtn = $('.commentbox_form .commentbox_btn');

    const handler = () => {
        if($input.val() === '') {
            $sendBtn.addClass('commentbox_btn-hidden');
        } else {
            $sendBtn.removeClass('commentbox_btn-hidden');
        }
    }

    $input.on('keyup', handler);
}
