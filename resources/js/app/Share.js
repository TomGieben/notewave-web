window.Share = class Share {
    static show() {
        const isPublic = (document.querySelector("input[name='note_is_public']").value == 1) ? true : false;
        const link = document.querySelector("input[name='note_share_link']").value;
        let status = '';

        if(isPublic) {
            status += `<i class="fas fa-lock-open" title="Your note is public"></i>`
        } else {
            status += `<i class="fas fa-lock" title="Your note is private"></i>`
        }

        let html = `
            <div class="d-flex w-100 justify-content-between">
                <div class="col-auto">
                    <b>Share youre note</b>
                </div>
                <div class="col-auto">
                    ${status}
                </div>
            </div>
        `;

        html += `
            <div class="input-group mt-4">
                <input class="form-control" value="${link}" disabled>
                <button type="button" onclick="Share.copy(this)" class="btn btn-success">
                    <i class="fas fa-link"></i> Copy
                </button>
            </div>
            <div class="alert alert-warning mt-3 p-1">
                <small>Anyone on the internet with this link can edit the note</small>
            </div>
        `;

        return new swal({
            showCancelButton: false,
            showConfirmButton: false, 
            html: html,  
        });
    }

    static copy(button) {
        const link = document.querySelector("input[name='note_share_link']").value;
        const icon = '<i class="fas fa-check"></i> Copied';
        const textArea = document.createElement("textarea");

        textArea.value = link;
        document.body.appendChild(textArea);
        textArea.focus();
        textArea.select();

        try {
          document.execCommand('copy');
        } catch (err) {
          console.error('Unable to copy to clipboard', err);
        }

        document.body.removeChild(textArea);
        button.disabled = true;
        button.innerHTML = icon;
    }
}
