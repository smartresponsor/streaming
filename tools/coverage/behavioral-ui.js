const fs = require('node:fs');
const path = require('node:path');

const outputDirectory = path.join(process.cwd(), 'var', 'coverage');
const outputPath = path.join(outputDirectory, 'behavioral-ui.json');

const evidence = {
  schema: 'behavioral-ui-coverage-v2',
  generatedAt: new Date().toISOString(),
  producer: {
    kind: 'repository_script',
    script: 'test:behavioral-coverage',
  },
  dimensions: {
    functional: { eligible: [], covered: [] },
    behavioral: { eligible: [], covered: [] },
    ui: { eligible: [], covered: [] },
    critical: { eligible: [], covered: [] },
  },
};

fs.mkdirSync(outputDirectory, { recursive: true });
fs.writeFileSync(outputPath, `${JSON.stringify(evidence, null, 2)}\n`);

console.log(`Wrote ${path.relative(process.cwd(), outputPath)}`);
