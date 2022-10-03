name: Feature idea
description: Suggest a new feature
labels: [feature, needs triage]
body:
- type: textarea
  attributes:
    label: "Feature summary:"
    description: |
     Is your feature request related to a problem? Please describe. You might use a clear and concise description of what the problem is. Ex. I'm always frustrated when [...]
  validations:
    required: true
- type: textarea
  attributes:
    label: "Proposal & Constraints:"
    description: |
      What is the proposed solution / implementation? What would you like to happen?
      Are their constraints or requirements that should be considered for how the feature needs to be?
  validations:
    required: false
- type: textarea
  attributes:
    label: "Additional context:"
    description: |
      Are there alternative solutions or features you've considered? Add any other context or screenshots about the feature request here.
  validations:
    required: false 
