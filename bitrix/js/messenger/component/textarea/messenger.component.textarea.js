import "./messenger.component.textarea.css";

/**
 * Bitrix Messenger
 * Textarea Vue component
 *
 * @package bitrix
 * @subpackage im
 * @copyright 2001-2019 Bitrix
 */

BX.Vue.component('bx-messenger-textarea',
{
	/**
	 * @emits 'send' {text: string}
	 * @emits 'edit' {}
	 * @emits 'writes' {text: string}
	 * @emits 'focus' {event: object} -- 'event' - focus event
	 * @emits 'blur' {event: object} -- 'event' - blur event
	 * @emits 'keyup' {event: object} -- 'event' - keyup event
	 * @emits 'keydown' {event: object} -- 'event' - keydown event
	 * @emits 'appButtonClick' {appId: string, event: object} -- 'appId' - application name, 'event' - event click
	 * @emits 'fileSelected' {fileInput: domNode} -- 'fileInput' - dom node element
	 */

	/**
	 * @listens props.listenEventInsertText {text: string, breakline: boolean, position: string, cursor: string, focus: boolean} (global|application) -- insert text to textarea, see more in methods.insertText()
	 * @listens props.listenEventFocus {} (global|application) -- set focus on textarea
	 * @listens props.listenEventBlur {} (global|application) -- clear focus on textarea
	 */

	props:
	{
		siteId: { default: 'default' },
		userId: { default: 0 },
		dialogId: { default: 0 },
		enableCommand: { default: true },
		enableMention: { default: true },
		desktopMode: { default: false },
		enableEdit: { default: false },
		enableFile: { default: false },
		sendByEnter: { default: true },
		autoFocus: { default: null },
		writesEventLetter: { default: 0 },
		styles: {
			type: Object,
			default: function () {
				return {}
			}
		},
		listenEventInsertText: { default: '' },
		listenEventFocus: { default: '' },
		listenEventBlur: { default: '' },
	},
	data()
	{
		return {
			placeholderMessage: '',
			currentMessage: '',
			previousMessage: '',
			commandListen: false,
			mentionListen: false,
			stylesDefault: Object.freeze({button: { backgroundColor: null, iconColor: null }})
		}
	},
	created()
	{
		if (this.listenEventInsertText)
		{
			BX.Vue.event.$on(this.listenEventInsertText, this.onInsertText);
			this.$root.$on(this.listenEventInsertText, this.onInsertText);
		}
		if (this.listenEventFocus)
		{
			BX.Vue.event.$on(this.listenEventFocus, this.onFocusSet);
			this.$root.$on(this.listenEventFocus, this.onFocusSet);
		}
		if (this.listenEventBlur)
		{
			BX.Vue.event.$on(this.listenEventBlur, this.onFocusClear);
			this.$root.$on(this.listenEventBlur, this.onFocusClear);
		}

		this.localStorage = BX.Messenger.LocalStorage;

		this.textareaHistory = this.localStorage.get(this.siteId, this.userId, 'textarea-history', {});
		this.currentMessage = this.textareaHistory[this.dialogId] || '';
		this.placeholderMessage = this.currentMessage;
	},
	beforeDestroy()
	{
		if (this.listenEventInsertText)
		{
			BX.Vue.event.$off(this.listenEventInsertText, this.onInsertText);
			this.$root.$off(this.listenEventInsertText, this.onInsertText);
		}
		if (this.listenEventFocus)
		{
			BX.Vue.event.$off(this.listenEventFocus, this.onFocusSet);
			this.$root.$off(this.listenEventFocus, this.onFocusSet);
		}
		if (this.listenEventBlur)
		{
			BX.Vue.event.$off(this.listenEventBlur, this.onFocusClear);
			this.$root.$off(this.listenEventBlur, this.onFocusClear);
		}
		clearTimeout(this.messageStoreTimeout);
		this.localStorage.set(this.siteId, this.userId, 'textarea-history', this.textareaHistory);
		this.localStorage = null;
	},
	computed:
	{
		textareaClassName()
		{
			return 'bx-im-textarea' + (BX.Messenger.Utils.device.isMobile()? ' bx-im-textarea-mobile': '');
		},

		buttonStyle()
		{
			let styles = Object.assign({}, this.stylesDefault, this.styles);

			let isIconDark = false;
			if (styles.button.iconColor)
			{
				isIconDark = BX.Messenger.Utils.isDarkColor(styles.button.iconColor);
			}
			else
			{
				isIconDark = !BX.Messenger.Utils.isDarkColor(styles.button.backgroundColor);
			}

			styles.button.className = isIconDark? 'bx-im-textarea-send-button': 'bx-im-textarea-send-button bx-im-textarea-send-button-bright-arrow';
			styles.button.style = styles.button.backgroundColor? 'background-color: '+styles.button.backgroundColor+';': '';

			return styles;
		},

		localize()
		{
			return BX.Vue.getFilteredPhrases('BX_MESSENGER_TEXTAREA_', this.$root.$bitrixMessages)
		},
	},
	directives: {
		'bx-im-focus':
		{
			inserted(element, params)
			{
				if (
					params.value === true
					|| params.value === null && !BX.Messenger.Utils.device.isMobile()
				)
				{
					element.focus();
				}
			}
		}
	},
	methods:
	{
		/**
		 *
		 * @param text
		 * @param breakline - true/false (default)
		 * @param position - start, current (default), end
		 * @param cursor - start, before, after (default), end
		 * @param focus - set focus on textarea
		 */
		insertText(text, breakline = false, position = 'current', cursor = 'after', focus = true)
		{
			let textarea = this.$refs.textarea;
			let selectionStart = textarea.selectionStart;
			let selectionEnd = textarea.selectionEnd;

			if (position == 'start')
			{
				if (breakline)
				{
					text = text+"\n";
				}
				textarea.value = text + textarea.value;

				if (focus)
				{
					if (cursor == 'after')
					{
						textarea.selectionStart = text.length;
						textarea.selectionEnd = textarea.selectionStart;
					}
					else if (cursor == 'before')
					{
						textarea.selectionStart = 0;
						textarea.selectionEnd = textarea.selectionStart;
					}
				}
			}
			else if (position == 'current')
			{
				if (breakline)
				{
					if (textarea.value.substring(0, selectionStart).trim().length > 0)
					{
						text = "\n"+text;
					}
					text = text+"\n";
				}
				textarea.value = textarea.value.substring(0, selectionStart) + text + textarea.value.substring(selectionEnd, textarea.value.length);

				if (focus)
				{
					if (cursor == 'after')
					{
						textarea.selectionStart = selectionStart+text.length;
						textarea.selectionEnd = textarea.selectionStart;
					}
					else if (cursor == 'before')
					{
						textarea.selectionStart = selectionStart;
						textarea.selectionEnd = textarea.selectionStart;
					}
				}
			}
			else if (position == 'end')
			{
				if (breakline)
				{
					if (textarea.value.substring(0, selectionStart).trim().length > 0)
					{
						text = "\n"+text;
					}
					text = text+"\n";
				}
				textarea.value = textarea.value+text;

				if (focus)
				{
					if (cursor == 'after')
					{
						textarea.selectionStart = textarea.value.length;
						textarea.selectionEnd = textarea.selectionStart;
					}
					else if (cursor == 'before')
					{
						textarea.selectionStart = textarea.value.length-text.length;
						textarea.selectionEnd = textarea.selectionStart;
					}
				}
			}

			if (focus)
			{
				if (cursor == 'start')
				{
					textarea.selectionStart = 0;
					textarea.selectionEnd = 0;
				}
				else if (cursor == 'end')
				{
					textarea.selectionStart = textarea.value.length;
					textarea.selectionEnd = textarea.selectionStart;
				}

				textarea.focus();
			}

			this.textChangeEvent();
		},

		sendMessage()
		{
			this.$emit('send', {text: this.currentMessage.trim()});

			let textarea = this.$refs.textarea;
			if (textarea)
			{
				textarea.value = '';
			}

			if (this.autoFocus === null || this.autoFocus)
			{
				textarea.focus();
			}

			this.textChangeEvent();
		},

		textChangeEvent()
		{
			let textarea = this.$refs.textarea;
			if (!textarea)
			{
				return;
			}

			let text = textarea.value.trim();
			if (this.currentMessage === text)
			{
				return;
			}

			if (this.writesEventLetter <= text.length)
			{
				this.$emit('writes', {text});
			}

			this.previousMessage = this.currentMessage;
			this.previousSelectionStart = textarea.selectionStart;
			this.previousSelectionEnd = this.previousSelectionStart;
			this.currentMessage = text;

			if (text.toString().length > 0)
			{
				this.textareaHistory[this.dialogId] = text;
			}
			else
			{
				delete this.textareaHistory[this.dialogId];
			}

			clearTimeout(this.messageStoreTimeout);
			this.messageStoreTimeout = setTimeout(() => {
				this.localStorage.set(this.siteId, this.userId, 'textarea-history', this.textareaHistory, this.userId? 0: 10);
			}, 500);
		},

		onKeyDown(event)
		{
			this.$emit('keydown', event);

			let textarea = event.target;
			let text = textarea.value.trim();
			let isMac = BX.Messenger.Utils.platform.isMac();
			let isCtrlTEnable = BX.Messenger.Utils.platform.isBitrixDesktop() || !BX.Messenger.Utils.browser.isChrome();

			// TODO see more im/install/js/im/im.js:12324
			if (this.commandListen)
			{
			}
			else if (this.mentionListen)
			{
			}
			else if (!(event.altKey && event.ctrlKey))
			{
				if (this.enableMention && (event.shiftKey  && (event.keyCode == 61 || event.keyCode == 50 || event.keyCode == 187 || event.keyCode == 187)) || event.keyCode == 107)
				{
					// mention case
				}
				else if (this.enableCommand && (event.keyCode == 191 || event.keyCode == 111 || event.keyCode == 220))
				{
					// command case
				}
			}

			if (event.keyCode == 27)
			{
				if (textarea.value != '' && textarea === document.activeElement)
				{
					event.preventDefault();
					event.stopPropagation();
				}
				if (event.shiftKey)
				{
					textarea.value = '';
				}
			}
			else if (event.metaKey || event.ctrlKey)
			{
				// TODO translit messages
				if (
					isCtrlTEnable && event.key === 't'
					|| !isCtrlTEnable && event.key === 'e'
				)
				{
					// translit case
					event.preventDefault();
				}
				else if (['b','s','i','u'].includes(event.key))
				{
					let selectionStart = textarea.selectionStart;
					let selectionEnd = textarea.selectionEnd;

					let tagStart = '['+event.key.toLowerCase()+']';
					let tagEnd = '[/'+event.key.toLowerCase()+']';
					let selected = textarea.value.substring(selectionStart, selectionEnd);

					if (selected.startsWith(tagStart) && selected.endsWith(tagEnd))
					{
						selected = selected.substring(tagStart.length, selected.indexOf(tagEnd));
					}
					else
					{
						selected = tagStart + selected + tagEnd;
					}

					textarea.value = textarea.value.substring(0, selectionStart) + selected + textarea.value.substring(selectionEnd, textarea.value.length);

					textarea.selectionStart = selectionStart;
					textarea.selectionEnd = selectionStart + selected.length;

					event.preventDefault();
				}
			}

			if (event.keyCode == 9)
			{
				this.insertText("\t");
				event.preventDefault();
			}
			else if (this.enableEdit && event.keyCode == 38 && text.length <= 0)
			{
				this.$emit('edit', {});
			}
			else if (event.keyCode == 13)
			{
				if (BX.Messenger.Utils.device.isMobile())
				{
				}
				else if (this.sendByEnter == true)
				{
					if (event.ctrlKey || event.altKey || event.shiftKey)
					{
						if (!event.shiftKey)
						{
							this.insertText("\n");
						}
					}
					else if (text.length <= 0)
					{
						event.preventDefault();
					}
					else
					{
						this.sendMessage();
						event.preventDefault();
					}
				}
				else
				{
					if (event.ctrlKey == true)
					{
						this.sendMessage();
						event.preventDefault();
					}
					else if (isMac && (event.metaKey == true || event.altKey == true))
					{
						this.sendMessage();
						event.preventDefault();
					}
				}
			}
			else if ((event.ctrlKey || event.metaKey) && event.key == 'z')
			{
				if (this.previousMessage)
				{
					textarea.value = this.previousMessage;
					textarea.selectionStart = this.previousSelectionStart;
					textarea.selectionEnd = this.previousSelectionEnd;

					this.previousMessage = '';
					event.preventDefault();
				}
			}
		},
		onKeyUp(event)
		{
			this.$emit('keyup', event);
			this.textChangeEvent();
		},
		onPaste(event)
		{
			this.$nextTick(this.textChangeEvent);
		},
		onInput(event)
		{
			this.textChangeEvent();
		},
		onFocus(event)
		{
			this.$emit('focus', event);
		},
		onBlur(event)
		{
			this.$emit('blur', event);
		},
		onAppButtonClick(appId, event)
		{
			this.$emit('appButtonClick', {appId, event});
		},
		onInsertText(event = {})
		{
			if (!event.text)
			{
				return false;
			}
			this.insertText(event.text, event.breakline, event.position, event.cursor, event.focus);

			return true;
		},
		onFocusSet()
		{
			this.$refs.textarea.focus();

			return true;
		},
		onFocusClear()
		{
			this.$refs.textarea.blur();

			return true;
		},
		onFileClick(event)
		{
			event.target.value = "";
		},
		onFileSelect(event)
		{
			this.$emit('fileSelected', {fileInput: event.target});
		},
	},
	template: `
		<div :class="textareaClassName">
			<div class="bx-im-textarea-box">
				<textarea ref="textarea" class="bx-im-textarea-input" @keydown="onKeyDown" @keyup="onKeyUp" @paste="onPaste" @input="onInput" @focus="onFocus" @blur="onBlur" v-bx-im-focus="autoFocus" :placeholder="localize.BX_MESSENGER_TEXTAREA_PLACEHOLDER">{{placeholderMessage}}</textarea>
				<transition enter-active-class="bx-im-textarea-send-button-show" leave-active-class="bx-im-textarea-send-button-hide">
					<button v-if="currentMessage" :class="buttonStyle.button.className" :style="buttonStyle.button.style" @click="sendMessage" :title="localize.BX_MESSENGER_TEXTAREA_BUTTON_SEND"></button>
				</transition>
			</div>
			<div class="bx-im-textarea-app-box">
				<label v-if="enableFile" class="bx-im-textarea-app-button bx-im-textarea-app-file" :title="localize.BX_MESSENGER_TEXTAREA_FILE"><input type="file" @click="onFileClick($event)" @change="onFileSelect($event)"></label>
				<button class="bx-im-textarea-app-button bx-im-textarea-app-smile" :title="localize.BX_MESSENGER_TEXTAREA_SMILE" @click="onAppButtonClick('smile', $event)"></button>
				<button v-if="false" class="bx-im-textarea-app-button bx-im-textarea-app-gif" :title="localize.BX_MESSENGER_TEXTAREA_GIPHY" @click="onAppButtonClick('giphy', $event)"></button>
			</div>
		</div>
	`
});