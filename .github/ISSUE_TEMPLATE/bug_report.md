name: Bug report
description: Create a report to help us improve
labels: [bug, needs triage]
body:
- type: markdown
  attributes:
    value: |
      Thanks for taking the time to fill out this bug report!
- type: input
  attributes:
    label: Where did you find the bug?
    description: Please provide the URL where you encountered the issue/s.
    placeholder: e.g. https://www.example.com
  validations:
    required: false
- type: textarea
  attributes:
    label: What went wrong?
    description: |
      Please provide a clear, brief summary of the issue. 
  validations:
    required: true
- type: textarea
  attributes:
    label: "Here's the problem:"
    description: |
      Describe the issue: What were you trying to do? What went wrong? The more detail you give, the easier it will be to fix!
      If you can, please write steps to reproduce the bug, e.g. "Step 1: I clicked on X. Step 2: I scrolled. Step 3: I clicked on Y and I expected...but..."
  validations:
    required: true
- type: textarea
  attributes:
    label: "Here's what I expected:"
    description: |
      Describe the issue: What did you expect that didn't happen? Please give a clear and concise description of what you expected to happen.
  validations:
    required: true
- type: textarea
  attributes:
    label: "Do you have screenshots?"
    description: |
      Screen captures of the issue are super useful to quickly replicate it.
      You can upload screenshots to this ticket; a gif replicating the error will literally give us shivers.
  validations:
    required: false
- type: textarea
  attributes:
    label: "Do you have screenshots?"
    description: |
      Screen captures of the issue are super useful to quickly replicate it.
      You can upload screenshots to this ticket; a gif replicating the error will literally give us shivers.
  validations:
    required: false
  - type: dropdown
    id: os
    attributes:
      label: Which operating system are you seeing the problem on?
      multiple: true
      options:
        - iOS
        - Mac OS
        - Windows
        - Chrome OS
        - Linux
        - Other
  validations:
    required: false
 - type: dropdown
    id: browsers
    attributes:
      label: What browsers are you seeing the problem on?
      multiple: true
      options:
        - Firefox
        - Chrome
        - Safari
        - Microsoft Edge
        - Other
  validations:
    required: false
 - type: textarea
	attributes:
    label: "Anything else?"
    description: |
      Describe the issue: Did you only notice the issue on mobile? Using a certain OS? Anything else you'd like us to know?
  validations:
    required: true
