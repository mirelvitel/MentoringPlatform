import { Mark } from '@tiptap/core'

const CustomClassMark = Mark.create({
    name: 'customClass',

    addOptions() {
        return {
            HTMLAttributes: {},
        }
    },

    addCommands() {
        return {
            setCustomClass: attributes => ({ commands }) => {
                return commands.setMark(this.name, attributes);
            },
            toggleCustomClass: attributes => ({ commands, range }) => {
                const { from, to } = range || commands.state.selection;
                const marks = commands.state.doc.rangeHasMark(from, to, this.type);

                if (marks) {
                    // If the mark is already applied, remove it
                    return commands.unsetMark(this.name);
                } else {
                    // Apply the mark if it's not already there
                    return commands.setMark(this.name, attributes);
                }
            },
        }
    },

    addAttributes() {
        return {
            class: {
                default: null,
                renderHTML: attributes => {
                    if (!attributes.class) {
                        return {}
                    }

                    return {
                        class: attributes.class,
                    }
                },
            },
        }
    },

    parseHTML() {
        return [
            {
                tag: 'span[class]',
                getAttrs: node => node.getAttribute('class') ? {} : false,
            },
        ]
    },

    renderHTML({ HTMLAttributes }) {
        return ['span', HTMLAttributes, 0]
    },
});
export default CustomClassMark;
