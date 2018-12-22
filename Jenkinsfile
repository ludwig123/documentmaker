Jenkinsfile (Declarative Pipeline)
pipeline {
    agent { docker { image 'php' } }
    stages {
        stage('build') {
            steps {
                cmd 'php --version'
            }
        }
    }
}
