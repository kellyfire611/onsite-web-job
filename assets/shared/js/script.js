const Regex = {
  test(regex, min, max, subject) {
    return !(subject.length < min || subject.length > max || !regex.test(subject));
  },
};
