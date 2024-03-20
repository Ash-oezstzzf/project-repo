const form = document.querySelector('form');
const taskNameInput = document.querySelector('#task-name');
const descriptionInput = document.querySelector('#description');
const dueDateInput = document.querySelector('#due-date');
const assignedToInput = document.querySelector('#assigned-to');
const newUserContainer = document.querySelector('#new-user-container');
const newUserInput = document.querySelector('#new-user-name');
const table = document.querySelector('table tbody');

form.addEventListener('submit', function(event) {
  event.preventDefault();

  let assignedTo = assignedToInput.value;

  if (assignedTo === 'New User') {
    assignedTo = newUserInput.value;

    const newOption = document.createElement('option');
    newOption.value = assignedTo;
    newOption.text = assignedTo;
    assignedToInput.insertBefore(newOption, newUserContainer.previousSibling);
  }

  const newRow = table.insertRow();

  const taskNameCell = newRow.insertCell();
  const descriptionCell = newRow.insertCell();
  const dueDateCell = newRow.insertCell();
  const assignedToCell = newRow.insertCell();
  const statusCell = newRow.insertCell();

  taskNameCell.textContent = taskNameInput.value;
  descriptionCell.textContent = descriptionInput.value;
  dueDateCell.textContent = dueDateInput.value;
  assignedToCell.textContent = assignedTo;
  statusCell.textContent = 'Not Started';

  taskNameInput.value = '';
  descriptionInput.value = '';
  dueDateInput.value = '';
  assignedToInput.value = 'Alice';
  newUserInput.value = '';
});

assignedToInput.addEventListener('change', function(event) {
  if (assignedToInput.value === 'New User') {
  
    newUserContainer.style.display = 'block';
  } else {
    
    newUserContainer.style.display = 'none';
  }
});
