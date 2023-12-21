import { React, createRoot } from '../../../reactImports.js';

// Define variable

// Function
function UserInformUpdateForm() {
    return (
        <x-form.post>

        </x-form.post>
    )
}

export default UserInformUpdateForm;

// Mount
const rootElement = document.querySelector('#user-inform-update-container');
const root = createRoot(rootElement);
root.render(<UserInformUpdateForm />);