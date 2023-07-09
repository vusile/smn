<h2><a href="/admin/mkeka">Rudi kwenye mkeka</a></h2>
<button class="btn" >Copy Message!</button>
<br />
<br />
<div style="color: seagreen; font-weight: bold; font-size: 24px" id="success"></div>
<div style="color: red; font-weight: bold; font-size: 24px" id="failure"></div>
<div id = "message">
    {!! $message !!}
</div>

<script>
    function fallbackCopyTextToClipboard(text) {
        var textArea = document.createElement("textarea");
        textArea.value = text;

        // Avoid scrolling to bottom
        textArea.style.top = "0";
        textArea.style.left = "0";
        textArea.style.position = "fixed";

        document.body.appendChild(textArea);
        textArea.focus();
        textArea.select();

        try {
            var successful = document.execCommand('copy');
            var msg = successful ? 'successful' : 'unsuccessful';
            console.log('Fallback: Copying text command was ' + msg);
            document.getElementById('success').innerHTML = "Umefanikiwa kucopy";
            document.getElementById('failure').innerHTML = ""
        } catch (err) {
            console.error('Fallback: Oops, unable to copy', err);
            document.getElementById('failure').innerHTML = "Kuna shida. Mtaarifu admin!";
            document.getElementById('success').innerHTML = ""
        }

        document.body.removeChild(textArea);
    }
    function copyTextToClipboard(text) {
        if (!navigator.clipboard) {
            fallbackCopyTextToClipboard(text);
            return;
        }
        navigator.clipboard.writeText(text).then(function() {
            console.log('Async: Copying to clipboard was successful!');
            document.getElementById('success').innerHTML = "Umefanikiwa kucopy";
            document.getElementById('failure').innerHTML = ""
        }, function(err) {
            console.error('Async: Could not copy text: ', err);
            document.getElementById('failure').innerHTML = "Kuna shida. Mtaarifu admin!";
            document.getElementById('success').innerHTML = ""
        });
    }

    var copyBtn = document.querySelector('.btn');

    copyBtn.addEventListener('click', function(event) {
        let text = document.getElementById('message').innerHTML
        copyTextToClipboard(htmlToFormat(text));
    });

    function htmlToFormat(html) {
        const codes = { B: "*", I: "_", STRIKE: "~", BR: "%0a" };
        const {body} = new DOMParser().parseFromString(html, "text/html");
        const dfs = ({childNodes}) => Array.from(childNodes, node => {
            if (node.nodeType === 1) {
                const s = dfs(node);
                const code = codes[node.tagName];
                return code ? s.replace(/^(\s*)(?=\S)|(?<=\S)(\s*)$/g, `$1${code}$2`) : s;
            } else {
                return node.textContent;
            }
        }).join("");

        return dfs(body);
    }

</script>

