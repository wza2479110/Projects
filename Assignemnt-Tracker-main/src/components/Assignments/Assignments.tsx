import Assignment from "../Assignment/Assignment";
import styles from "./assignments.module.css";

interface AssignmentProperties {
  id: number;
  name: string;
  completed: boolean;
  deadline: Date;
}

interface AssignmentsProps {
    assignments: AssignmentProperties[]
    setAssignments: Function;
}

const Assignments = ({ assignments, setAssignments }: AssignmentsProps) => {
  const getCompleted = () => {
    return assignments.filter(value => value.completed).length;
  }

  return (
    <section className={styles.assignments}>
      <header className={styles.header}>
        <div>
          <p>Created Assignments</p>
          <span>{assignments.length}</span>
        </div>

        <div>
          <p className={styles.textPurple}>Completed Assignments</p>
          <span>{getCompleted()} of {assignments.length}</span>
        </div>
      </header>

      <div className={styles.list}>
        {assignments.map((assignment) => (
          <Assignment 
            assignment={assignment} 
            assignments={assignments}
            setAssignments={setAssignments} 
            key={assignment.id} 
            />
        ))}
      </div>
    </section>
  );
}

export default Assignments;
