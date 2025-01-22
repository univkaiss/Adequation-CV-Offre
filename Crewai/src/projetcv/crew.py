from crewai import Agent, Crew, Process, Task
from crewai.project import (CrewBase, after_kickoff, agent, before_kickoff,crew,task)

@CrewBase

class Projetcv():
    """Projetcv crew"""

    # Learn more about YAML configuration files here:
    # Agents: https://docs.crewai.com/concepts/agents#yaml-configuration-recommended
    # Tasks: https://docs.crewai.com/concepts/tasks#yaml-configuration-recommended
    agents_config = 'config/agents.yaml'
    tasks_config = 'config/tasks.yaml'

    
    # If you would like to add tools to your agents, you can learn more about it here:
    # https://docs.crewai.com/concepts/agents#agent-tools
	
    @agent
    def cv_matcher(self) -> agent:
        return Agent(
            config=self.agents_config['cv_matcher'],
            verbose=True
        )

    @agent
    def cv_improver(self) -> agent:
        return Agent(
            config=self.agents_config['cv_improver'],
            verbose=True
        )

    @agent
    def motivation_letter_writer(self) -> agent:
        return Agent(
            config=self.agents_config['motivation_letter_writer'],
            verbose=True
        )

    @task
    def evaluate_cv(self) -> Task:
        return Task(
            config=self.tasks_config['evaluate_cv'],
            output_file='report.md',
        )

    @task
    def improve_cv(self) -> Task:
        return Task(
            config=self.tasks_config['improve_cv'],
            output_file='improved_cv.md',
        )

    @task
    def write_motivation_letter(self) -> Task:
        return Task(
            config=self.tasks_config['write_motivation_letter'],
            output_file='motivation_letter.pdf',
        )

    @crew
    def crew(self) -> Crew:
        """Creates the Projetcv crew"""
        return Crew(
            agents=self.agents,
            tasks=self.tasks,
            process=Process.sequential,
            verbose=True,
        )
