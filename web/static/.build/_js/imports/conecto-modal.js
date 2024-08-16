const template = document.createElement('template');
template.innerHTML = `
    <style>
        .conecto-modal {
            position: fixed;
            z-index: 1999999;
            width: 100vw;
            height: 100vh;
            background: rgba(0,0,0,0.5);
            top: 0;
            left: 0;
            visibility: visible;
            opacity: 1;
            transition: opacity ease-in-out .5s, visibility ease-in-out .5s;
        }        
        .conecto-modal.is-hidden { 
            opacity: 0;
            visibility: hidden; 
         }
        .conecto-modal--inner {
            padding: 30px;
            border: 5px solid var(--cm-border-color, #69bfac);
            background: white;
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translateX(-50%) translateY(-50%);
            width: 35vw;
        }
        @media only screen and (max-width: 767px) {        
            .conecto-modal--inner {
                width: 75vw;
            }
        }
        .conecto-modal h2 {
            margin: 0 0 20px 0;
        }
        .conecto-modal button {
            appearance: none;
            background: none;
            cursor: pointer;
            border: 0;
            position: absolute;
            top: 14px;            
            right: 14px;
            width: 20px;
            height: 20px;
            transition: transform ease-in-out .12s;
        }
        
        .conecto-modal button:focus {
            outline: none;
        }
        .conecto-modal button:hover {
            transform: scale(1.3);
        }
        .conecto-modal button span:before,
        .conecto-modal button span:after {
            content: '';
            width: 27px;
            height: 2px;
            background: var(--cm-border-color, #69bfac);
            position: absolute;
            top: 9px;
            left: -3px;
        }
        .conecto-modal button span:before {
            transform: rotate(45deg);
        }
        .conecto-modal button span:after {
            transform: rotate(-45deg);
        
        }
    </style>
    <div class="conecto-modal is-hidden">
        <div class="conecto-modal--inner">
            <h2><slot name="headline"></slot></h2>
            <slot name="text"></slot>
            <button id="toggle-info">
                <span></span>
            </button>
        </div>
    </div>
`;

class ConectoModal extends HTMLElement {

    _checkExpiration (){
        //check if past expiration date
        var values = JSON.parse(localStorage.getItem('conecto-modal-expiration'));
        console.log(values);
        //check "my hour" index here
        /*if (values[1] < new Date()) {
            console.log("blub");
            //localStorage.removeItem("storedData")
            this.storage = localStorage.getItem('conecto-modal-visible');
        }*/
    }

    constructor() {
        super();
        this._attributes = {
            visible: false
        };

        this._checkExpiration();

        this.storage = localStorage.getItem('conecto-modal-visible');

        this.attachShadow({mode: 'open'});
        this.shadowRoot.appendChild(template.content.cloneNode(true));

        this.html = {};
        this.html.modal = this.shadowRoot.querySelector('.conecto-modal');
        this.html.button = this.shadowRoot.querySelector('button');
        this.html.message = this.shadowRoot.querySelector('.message');

        this.html.button.addEventListener('click', event => {
            this._attributes.visible = false;
            this._triggerVisibilityClass();
            let myHour = new Date();
            myHour.setHours(myHour.getHours() + 24);
            localStorage.setItem('conecto-modal-expiration', JSON.stringify(myHour));
            localStorage.setItem('conecto-modal-visible', true);
            event.preventDefault();
        });

        // get properties from element
        if ( this.hasAttribute('visible') ) {
            this._attributes.visible = true;
        }
    }

    /**
     * dom stuff & initialization
     */
    connectedCallback() {

    }

    /**
     * cleanups
     */
    disconnectedCallback() {
    }

    _triggerVisibilityClass() {
        if ( !this.storage ) {
            if ( this._attributes.visible ) {
                this.html.modal.classList.remove('is-hidden');
            } else {
                this.html.modal.classList.add('is-hidden');
            }
        }
    }

    /**
     * What are my observable properties?
     * @returns {boolean[]}
     */
    static get observedAttributes() {
        return ['visible'];
    }

    /**
     * check for changes
     * @param name
     * @param oldValue
     * @param newValue
     */
    attributeChangedCallback(name, oldValue, newValue) {
        if ( oldValue === newValue ) {
            return;
        }
        if ( name === 'visible') {
            this._triggerVisibilityClass();
        }
    }
}

window.customElements.define('conecto-modal', ConectoModal);