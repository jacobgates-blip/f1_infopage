CREATE TABLE IF NOT EXISTS races (
    id INT AUTO_INCREMENT PRIMARY KEY,
    round_number INT NOT NULL,
    race_name VARCHAR(100) NOT NULL,
    circuit_name VARCHAR(100) NOT NULL,
    race_date DATE NOT NULL
);

CREATE TABLE IF NOT EXISTS results (
    id INT AUTO_INCREMENT PRIMARY KEY,
    race_id INT NOT NULL,
    driver_name VARCHAR(50) NOT NULL,
    team_name VARCHAR(50) NOT NULL,
    position INT NOT NULL,
    points INT NOT NULL,
    FOREIGN KEY (race_id) REFERENCES races(id)
);

-- Insert a sample race
INSERT INTO races (round_number, race_name, circuit_name, race_date) VALUES 
(1, 'Bahrain Grand Prix', 'Bahrain International Circuit', '2024-03-02');

-- Insert sample results for that race
INSERT INTO results (race_id, driver_name, team_name, position, points) VALUES 
(1, 'Max Verstappen', 'Red Bull Racing', 1, 26),
(1, 'Sergio Perez', 'Red Bull Racing', 2, 18),
(1, 'Carlos Sainz', 'Ferrari', 3, 15);
