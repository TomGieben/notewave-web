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
                    <b>Share your note</b>
                </div>
                <div class="col-auto">
                    ${status}
                </div>
            </div>
        `;

        html += `
            <div class="input-group mt-4">
                <input class="form-control" value="${link}" disabled>
                <button title="Copy" type="button" onclick="Share.copy(this)" class="btn btn-success">
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

    static add() {
        let html = `
            <div class="d-flex w-100 justify-content-between">
                <div class="col-auto">
                    <b>Store this note</b>
                </div>
            </div>
        `;

        html += `
            <div class="alert alert-warning mt-3 p-1">
                <small>The note will be added to your own notes</small>
            </div>
            <div class="d-flex w-100 justify-content-between">
                <div class="col-auto">
                    <button title="Confirm" type="button" onclick="Share.store(this)" class="btn btn-success">
                        <i class="fas fa-check"></i> Confirm
                    </button>
                </div>
                <div class="col-auto">
                    <button title="Refuse" type="button" onclick="swal.close()" class="btn btn-secondary">
                        <i class="fas fa-times"></i> Refuse
                    </button>
                </div>
            </div>
        `;

        return new swal({
            showCancelButton: false,
            showConfirmButton: false, 
            html: html,  
        });
    }

    static async store(button) {
        const addBtn = document.getElementById('add-btn');
        const sharingKey = document.querySelector("input[name='note_sharing_key']").value;
        const url = document.querySelector("input[name='note_add_route']").value;
        const csrf = document.querySelector("meta[name='csrf-token']").content;
        const icon = '<i class="fas fa-check"></i> Confirmed';

        await fetch(url, {
            method: "POST",
            headers: {
                "X-CSRF-TOKEN": csrf,
                "Content-Type": "application/json",
            },
            body: JSON.stringify({
                "sharing_key" : sharingKey,
            }),
         }).then(response => {
            console.log(response);
        }).then(data => {
            console.log(data);
        });

        addBtn.disabled = true;
        button.disabled = true;
        button.innerHTML = icon;
    }
}
