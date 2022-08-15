;/**
 * LSX Starter Child scripts
 *
 * @package 	thesafaripartners-child
 */(function($, window, document, undefined) {

	'use strict';
})( jQuery, window, document );

'use strict';
    window.addEventListener('load', () => {
      let intro = new ShowMore('lsx-readmore', 'read_more', 300);
    });

    function ShowMore(e, l, stop) {
      this.e = document.getElementById(e);
      this.eText = this.e.innerText;
      this.stop = stop;
      this.l = document.getElementById(l);

      this.l.addEventListener('click', (e) => {
        this.expand_text();
        e.preventDefault();
        e.stopPropagation();
      });

      this.get_length = () => {
        return this.e.innerText.length;
      };

      this.hide_text = () => {
        this.e.innerText = this.e.innerText.substr(0, this.stop) + '\u2026';
        this.l.style.display = 'inline';
        this.e.appendChild(this.l);
      }

      this.expand_text = () => {
        this.e.innerText = this.eText;
      }

      this.show = () => {
        return (this.get_length() > this.stop) ? this.hide_text() : this.expand_text();
      };

      this.show();
    };